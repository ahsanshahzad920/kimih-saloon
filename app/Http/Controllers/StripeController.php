<?php

namespace App\Http\Controllers;

use App\Models\AddToCart;
use App\Models\Product;
use App\Models\Sale;
use App\Models\User;
use App\Services\EasypaisaService;
use App\Services\JazzCashService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Stripe;

class StripeController extends Controller
{
    private $stripe;

    public function __construct()
    {
        $this->stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
    }

    public function jazzcashCheckout(Request $request, JazzCashService $jazzCash)
    {
        if (!(settings()?->jazzcash_enabled ?? true)) {
            return response()->json(['status' => 400, 'message' => 'JazzCash is currently disabled.']);
        }

        $request->validate([
            'store_id' => 'required',
            'grand_total' => 'required',
            'items' => 'required',
        ]);

        $txnRefNo = 'JPR' . now()->format('YmdHis') . rand(1000, 9999);
        Cache::put('checkout_' . $txnRefNo, $request->all(), now()->addHour());

        $checkout = $jazzCash->buildCheckoutFields(
            $txnRefNo,
            $this->taxCalculate($request->grand_total),
            route('stripe.checkout.jazzcash.callback'),
            'Kimih Product Order'
        );

        return response()->json(['status' => 200] + $checkout);
    }

    public function jazzcashCallback(Request $request)
    {
        $jazzCash = new JazzCashService();
        $response = $request->all();

        if (!$jazzCash->verifyResponse($response) || !$jazzCash->isSuccessful($response)) {
            return redirect()->route('customer.product.orders')->with('error', 'JazzCash payment failed or could not be verified.');
        }

        $data = Cache::pull('checkout_' . $response['pp_TxnRefNo']);
        if (!$data) {
            return redirect()->route('customer.product.orders')->with('error', 'This payment session has expired.');
        }

        $this->completeProductCheckout($data, 'JazzCash', $response['pp_RetreivalReferenceNo'] ?? $response['pp_TxnRefNo']);

        return redirect()->route('customer.product.orders');
    }

    public function easypaisaCheckout(Request $request, EasypaisaService $easypaisa)
    {
        if (!(settings()?->easypaisa_enabled ?? true)) {
            return response()->json(['status' => 400, 'message' => 'Easypaisa is currently disabled.']);
        }

        $request->validate([
            'store_id' => 'required',
            'grand_total' => 'required',
            'items' => 'required',
        ]);

        $orderRefNum = 'EPR' . now()->format('YmdHis') . rand(1000, 9999);
        Cache::put('checkout_' . $orderRefNum, $request->all(), now()->addHour());

        $checkout = $easypaisa->buildCheckoutFields(
            $orderRefNum,
            $this->taxCalculate($request->grand_total),
            route('stripe.checkout.easypaisa.callback')
        );

        return response()->json(['status' => 200] + $checkout);
    }

    public function easypaisaCallback(Request $request)
    {
        $easypaisa = new EasypaisaService();
        $response = $request->all();

        if (!$easypaisa->isSuccessful($response)) {
            return redirect()->route('customer.product.orders')->with('error', 'Easypaisa payment failed or could not be verified.');
        }

        $orderRefNum = $response['orderRefNumber'] ?? $response['orderRefNum'] ?? null;
        $data = $orderRefNum ? Cache::pull('checkout_' . $orderRefNum) : null;
        if (!$data) {
            return redirect()->route('customer.product.orders')->with('error', 'This payment session has expired.');
        }

        $this->completeProductCheckout($data, 'Easypaisa', $response['transactionId'] ?? $orderRefNum);

        return redirect()->route('customer.product.orders');
    }

    /**
     * Shared sale creation used by every gateway's success callback.
     * $data is the raw original checkout request payload (store_id, grand_total, items, client_id).
     */
    private function completeProductCheckout(array $data, string $paymentMethod, ?string $transactionId): Sale
    {
        $data['invoice_number'] = 'INV-' . rand(10000, 99999) . date('Ymd') . rand(10000, 99999);
        $data['date'] = date('Y-m-d');
        $data['sub_total'] = $data['grand_total'] = $data['grand_total'];
        $data['cash_received'] = $data['grand_total'];
        $data['cash_return'] = 0;
        $data['due_amount'] = 0;
        $data['status'] = 'Completed';
        $data['payment_method'] = $paymentMethod;
        $data['created_by'] = $data['updated_by'] = $data['store_id'];
        $data['client_id'] = auth()->id();

        $sale = Sale::create($data);

        foreach ($data['items'] as $item) {
            $product = Product::find($item['product_id']);
            $sale->items()->create([
                'item_id' => $item['product_id'],
                'type' => 'product',
                'quantity' => $item['quantity'],
                'price' => $product->retail_price,
                'sub_total' => $product->retail_price * $item['quantity'],
                'created_by' => $data['store_id'],
                'updated_by' => $data['store_id'],
            ]);
            AddToCart::find($item['cart_id'])->delete();
        }

        $sale->payments()->create([
            'client_id' => $sale->client_id,
            'payment_date' => $sale->date,
            'payment_method' => $paymentMethod,
            'paid_amount' => $sale->cash_received,
            'type' => 'Sale',
            'created_by' => $data['store_id'],
            'updated_by' => $data['store_id'],
            'stripe_id' => $transactionId,
        ]);

        return $sale;
    }

    public function stripeCheckout(Request $request)
    {
        if (!(settings()?->stripe_enabled ?? false)) {
            return response()->json(['status' => 400, 'message' => 'Stripe is currently disabled.']);
        }

        $request->validate([
            'store_id' => 'required',
            'grand_total' => 'required',
            'items' => 'required',
            'items.*.product_id' => 'required',
            'items.*.quantity' => 'required',
        ]);
        
        $jsonEncode = json_encode($request->all());
        // return $request;
        $redirectUrl = route('stripe.checkout.success') . '?session_id={CHECKOUT_SESSION_ID}';
        // Calculate platform fee (2.5%)
        $platformFeePercentage = 0.025;
        $platformFee = $request->grand_total * $platformFeePercentage;
        
        // Convert amounts to cents
        $platformFee_cents = (int)($platformFee * 100); // Ensure platform fee is an integer in cents

        $response = $this->stripe->checkout->sessions->create([
            'success_url' => $redirectUrl,

            'customer_email' => auth()->user()->email ?? 'demo@gmail.com',

            'payment_method_types' => ['link', 'card'],

            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'aed',
                        'product_data' => [
                            'name' => "Products",
                        ],
                        'unit_amount' => $this->taxCalculate($request->grand_total) * 100,
                    ],
                    'quantity' => 1
                ],
            ],

            'mode' => 'payment',
            'allow_promotion_codes' => false,
            'metadata' => [
                'request' => $jsonEncode,
            ],
            'payment_intent_data' => [
                'application_fee_amount' => $platformFee_cents, // Platform fee in cents
                'transfer_data' => [
                    'destination' => env('STRIPE_CONNECTED_ACCOUNT_ID'), // Fetch from .env
                ],
            ],
        ]);

        // return redirect($response['url']);
        if (isset($response->id) && $response->id != '') {
            // return redirect($response->url);
            return response()->json(['url' => $response->url, 'status' => 200]);
        } else {
            return redirect()->route('cancel');
        }
    }

    public function stripeCheckoutSuccess(Request $request)
    {
        $response = $this->stripe->checkout->sessions->retrieve($request->session_id);

        // dd($response->metadata->event_id);
        // Get the Stripe payment ID
        $stripePaymentId = $response->payment_intent;
        // Retrieve the PaymentIntent object using the payment intent ID
        // $paymentIntent = $this->stripe->paymentIntents->retrieve($stripePaymentId);

        $data = json_decode($response->metadata->request, true);


        $data['invoice_number'] = 'INV-' . rand(10000, 99999) . date('Ymd') . rand(10000, 99999);
        $data['date'] = date('Y-m-d');
        $data['sub_total'] = $data['grand_total'] = $data['grand_total'];
        $data['cash_received'] = $data['grand_total'];
        $data['cash_return'] = 0;
        $data['due_amount'] = 0;
        $data['status'] = "Completed";
        $data['payment_method'] = "Cash On Delivery";
        $data['created_by'] = $data['updated_by'] =  $data['store_id'];
        $data['client_id'] = auth()->id();

        $sale = Sale::create($data);

        foreach ($data['items'] as $item) {
            $product = Product::find($item['product_id']);
            $sale->items()->create([
                'item_id' => $item['product_id'],
                'type' => 'product',
                'quantity' => $item['quantity'],
                'price' => $product->retail_price,
                'sub_total' => $product->retail_price * $item['quantity'],
                'created_by' => $data['store_id'],
                'updated_by' => $data['store_id'],
            ]);
            AddToCart::find($item['cart_id'])->delete();
        }
        $sale->payments()->create([
            'client_id' => $sale->client_id,
            'payment_date' => $sale->date,
            'payment_method' => 'Stripe',
            'paid_amount' => $sale->cash_received,
            'type' => 'Sale',
            'created_by' => $data['store_id'],
            'updated_by' => $data['store_id'],
            'stripe_id' => $stripePaymentId,
        ]);


        // $order = ProductOrder::create($data);
        // foreach($data['items'] as $item){
        //     $product = Product::find($item['product_id']);
        //     $order->items()->create([
        //         'product_id' => $item['product_id'],
        //         'quantity' => $item['quantity'],
        //         'price' => $product->retail_price,
        //     ]);
        //     AddToCart::find($item['cart_id'])->delete();
        // }
        // return response()->json(['status' => 200, 'message' => 'Order placed successfully']);


        return redirect()->route('customer.product.orders');
    }

    // protected function taxCalculate($originalAmount)
    // {
    //     // Constants for fees
    //     $percentageFee = 2.5 / 100;
    //     $stripeFee = 1;
    //     $textFee = 0.15;
    //     $emailFee = 0.05;

    //     // Calculate fees
    //     $percentageFeeAmount = $originalAmount * $percentageFee;
    //     $totalFees = $percentageFeeAmount + $stripeFee + $textFee + $emailFee;

    //     // Calculate total amount
    //     $totalAmount = $originalAmount + $totalFees;

    //     return (int)$totalAmount;
    // }

    // function taxCalculate($priceInUSD)
    // {
    //     // Define your fees
    //     $ourFeeRate = 0.025;
    //     $stripeFeeRate = 0.029; // Example Stripe fee rate (2.9%)
    //     $stripeFixedFeeAED = 1; // Fixed fee in AED
    //     $textFeeAED = 0.15;
    //     $emailFeeAED = 0.05;

    //     // Assuming you have the exchange rate from AED to USD
    //     $exchangeRateAEDToUSD = $this->getExchangeRate('AED', 'USD');

    //     // Convert fixed fees from AED to USD
    //     $stripeFixedFeeUSD = $stripeFixedFeeAED * $exchangeRateAEDToUSD;
    //     $textFeeUSD = $textFeeAED * $exchangeRateAEDToUSD;
    //     $emailFeeUSD = $emailFeeAED * $exchangeRateAEDToUSD;

    //     // Calculate the fees
    //     $ourFee = $priceInUSD * $ourFeeRate;
    //     $stripeFee = ($priceInUSD * $stripeFeeRate) + $stripeFixedFeeUSD;
    //     $totalTextFee = $textFeeUSD * 2; // Assuming 2 texts as per your example
    //     $totalEmailFee = $emailFeeUSD; // Assuming 1 email as per your example

    //     // Calculate the total amount
    //     $totalAmount = $priceInUSD + $ourFee + $stripeFee + $totalTextFee + $totalEmailFee;

    //     return (int) $totalAmount;
    // }

    // function getExchangeRate($fromCurrency, $toCurrency)
    // {
    //     // Make an API call to get the exchange rate (replace 'YOUR_API_KEY' with your actual API key)
    //     $response = Http::get("https://api.exchangerate-api.com/v4/latest/{$fromCurrency}");
    //     $data = $response->json();
    //     return $data['rates'][$toCurrency];
    // }

    function taxCalculate($amount)
    {
        // Fees
        $ourFee = 0.025 * $amount;
        $stripeFee = 0.029 * $amount + 1.00;
        $textFee = 0.15;
        $emailFee = 0.05;

        $totalFee = $ourFee + $stripeFee + $textFee + $emailFee;

        // Return total fee
        return (int)($totalFee + $amount);
    }
}
