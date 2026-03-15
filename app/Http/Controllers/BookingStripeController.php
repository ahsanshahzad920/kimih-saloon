<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Membership;
use App\Models\PaidPlan;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Stripe;

class BookingStripeController extends Controller
{
    private $stripe;

    public function __construct()
    {
        $this->stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
    }

    public function stripeCheckout(Request $request)
    {
        $jsonEncode = json_encode($request->all());

        $services = $request->services;

        $grand_total = 0;

        foreach ($services as $service) {
            $service = Service::find($service);
            $grand_total += $service->price;
        }

        // Calculate platform fee (2.5%)
        $platformFeePercentage = 0.025;
        $platformFee = $grand_total * $platformFeePercentage;
        
        // Convert amounts to cents
        $grand_total_cents = $this->taxCalculate($grand_total) * 100;
        $platformFee_cents = (int)($platformFee * 100); // Ensure platform fee is an integer in cents

        $redirectUrl = route('booking.stripe.checkout.success') . '?session_id={CHECKOUT_SESSION_ID}';

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
                        'unit_amount' => $grand_total_cents, // Stripe requires amount in cents
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

        if (isset($response->id) && $response->id != '') {
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

        $data = json_decode($response->metadata->request, true);
        // dd(is_array($data['services']));


        $data['service_ids'] = implode(',', $data['services']);
        $data['start'] = date('Y-m-d H:i:s', strtotime($data['start']));
        $data['end'] = date('Y-m-d H:i:s', strtotime($data['end']));
        $data['status'] = 'Booked';
        $data['payment_status'] = 'paid';
        $data['created_by'] = $data['business_id'];
        $data['updated_by'] = $data['business_id'];
        $data['grand_total'] = 0;

        $data['ref'] = 'AP-' . rand(111111, 999999);
        // dd($data);

        $appointment = Appointment::create($data);

        $services = $data['services'];
        // dd($services);

        foreach ($services as $service) {
            $service = Service::find($service);
            $appointment->services()->create([
                'service_id' => $service->id,
                'price' => $service->price ?? 0
            ]);
            $data['grand_total'] += $service->price;
        }
        $g_total = $this->taxCalculate($data['grand_total']);
        // dd($g_total);
        $appointment->update(['grand_total' => $g_total]);


        // ========================== Sales Create ====================================

        // $request->validate([
        //     'client_id' => 'required',
        //     // 'payment_method' => 'required',
        //     'cash_received' => 'required',
        //     'grand_total' => 'required',
        //     'order_items' => 'required',
        // ]);

        // $data = $request->all();
        $data['client_id'] = auth()->id();
        $data['cash_received'] = $g_total;
        $data['grand_total'] = $g_total;
        $data['order_items'] = $services;
        $data['payment_method'] = 'stripe';


        $data['invoice_number'] = 'INV-' . rand(10000, 99999) . date('Ymd') . rand(10000, 99999);
        $data['date'] = date('Y-m-d');
        $data['created_by'] = $data['updated_by'] =  auth()->id();

        if (!isset($data['status']) || $data['status'] != "Unpaid") {
            if ($data['grand_total'] > $data['cash_received']) {
                $data['status'] = 'Part Paid';
            } elseif ($data['cash_received'] == 0) {
                $data['status'] = 'Unpaid';
            } else {
                $data['status'] = "Paid";
            }
        }

        // dd($data);
        $sale = Sale::create($data);

        foreach ($data['order_items'] as $item) {
            // if ($item['type'] == 'product') {
            //     $product = Product::find($item['item_id']);
            //     $product->current_stock_quantity = $product->current_stock_quantity - $item['quantity'];
            //     $product->save();
            // }
            // if ($sale->cash_received > 0) {
            //     if ($item['type'] == 'appointment') {
            //         $appointment = Appointment::find($item['item_id']);
            //         $appointment->status = 'Completed';
            //         $appointment->save();
            //     }
            // }

            $appointment = Appointment::find($appointment->id);
            $appointment->status = 'Booked';
            $appointment->save();

            $iitem = [
                'sale_id' => $sale->id,
                'item_id' => $appointment->id,
                'type' => 'appointment',
                'quantity' => '1',
                'price' => $appointment->grand_total,
                'sub_total' => $appointment->grand_total,

                'created_by' => $data['business_id'],
                'updated_by' => $data['business_id'],
            ];
            // if ($item['type'] == 'membership') {
            //     $membership = Membership::find($item['item_id']);
            //     $valid_for = $membership->valid_for;
            //     PaidPlan::create([
            //         'client_id' => $sale->client_id,
            //         'membership_id' => $item['item_id'],
            //         'type' => 'One-time',
            //         'start_date' => date('Y-m-d'),
            //         'end_date' => date('Y-m-d', strtotime('+' . $valid_for)),
            //         'total_charged' => $item['price'],
            //         'status' => '1',
            //         'created_by' => auth()->id(),
            //         'updated_by' => auth()->id(),
            //     ]);
            // }
            // $item['created_by'] = auth()->id();
            // $item['updated_by'] = auth()->id();
            $sale->items()->create($iitem);
        }

        if (!isset($data['status']) || $data['status'] != "Unpaid") {
            $sale->payments()->create([
                'client_id' => $sale->client_id,
                'cash_received_by' => $sale->cash_received_by,
                'payment_date' => $sale->date,
                'payment_method' => 'Stripe',
                'paid_amount' => $g_total,
                'type' => 'Sale',
                'created_by' => auth()->id(),
                'updated_by' => auth()->id(),
                'stripe_id' => $stripePaymentId,

            ]);
        }


        return redirect()->route('customer.appointments');
        // return response()->json(['status' => 200, 'message' => 'Appointment booked successfully']);
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
