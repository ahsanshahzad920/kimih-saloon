<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\User;
use App\Models\Client;
use App\Jobs\SendEmailJob;
use Illuminate\Http\Request;
use App\Mail\NewEmailRegistered;
use App\Models\EmailSubscription;
use Illuminate\Support\Facades\Log;
use DB;
use Illuminate\Support\Facades\Mail;
use SebastianBergmann\Complexity\Complexity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Stripe;

class EmailSubscriptionController extends Controller
{
    private $stripe;

    public function __construct()
    {
        $this->stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subscriptions = EmailSubscription::all();

        return view('admin.email-subscription.index', compact('subscriptions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $email = $request->email;

        try {
            Mail::to('info@kimih.com')->send(new NewEmailRegistered($email));
        } catch (\Exception $e) {
            Log::error('Failed to send email: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Subscription successful, but failed to notify admin.');
        }

        // Save the email to the database
        EmailSubscription::create([
            'email' => $request->email
        ]);

        return back()->with('success', 'You will be notified soon!');
    }




    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = EmailSubscription::find($id);

        $data->delete();

        return response()->json(['status' => true, 'message' => 'Email deleted successfully!']);
    }

    // Send Mails

    public function sendMailIndex()
    {
        $customers = Client::where('created_by',auth()->id())->get();
        return view('admin.email-subscription.send-mails',compact('customers'));
    }

    // public function sendMails(Request $request)
    // {
    //     $request->validate([
    //         'subject' => 'required|string',
    //         'body' => 'required|string',
    //         'attach' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx,txt|max:5120',
    //     ]);

    //     $emails = EmailSubscription::select('email')->get()->pluck('email');
    //     $leadEmails = Lead::select('email')->get()->pluck('email');

    //     // Merge and remove duplicates
    //     $allEmails = $emails->merge($leadEmails)->unique();


    //     if ($emails->isEmpty()) {
    //         return back()->with('error', 'No email subscriptions found.');
    //     }

    //     $attach = null;

    //     // return $allEmails;

    //     if ($request->hasFile('attach'))
    //         $attach = $request->file('attach')->store('attch', 'public');

    //     foreach ($allEmails as $email) {
    //         SendEmailJob::dispatch($email, $request->subject, $request->body, $attach);
    //     }

    //     return redirect()->route('sub.index')->with('success', 'Emails are being sent.');
    // }

    public function sendMails(Request $request)
    {
        $request->validate([
            'subject' => 'required|string',
            'customer_id' => 'required',
            'body' => 'required|string',
            'attach' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx,txt|max:5120',
        ]);


        $costPerEmail = 0.05;

        // Check if user has 'Business User' role and sufficient balance
        $user = auth()->user();
        if ($user->hasRole('Business User')) {
            if ($user->balance < $costPerEmail) {
                return back()->with('error', 'Your balance is too low. Please recharge your account.');
            }
        }

        $attach = null;
        if ($request->hasFile('attach')) {
            $attach = $request->file('attach')->store('attch', 'public');
        }

        DB::beginTransaction();

        try {
            $email = User::find($request->customer_id)->email;
            SendEmailJob::dispatch($email, $request->subject, $request->body, $attach);

            // Deduct balance if user has 'Business User' role
            if ($user->hasRole('Business User')) {
                $user->balance -= $costPerEmail;
                $user->save();
            }

            DB::commit();

            return redirect()->route('sub.index')->with('success', 'Emails are being sent.');
        } catch (\Exception $e) {

            DB::rollBack();
            Log::error('Failed to send emails: ' . $e->getMessage());
            return back()->with('error', 'Failed to send emails: ' . $e->getMessage());
        }
    }
    // public function sendMails(Request $request)
    // {
    //     $request->validate([
    //         'subject' => 'required|string',
    //         'body' => 'required|string',
    //         'attach' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx,txt|max:5120',
    //     ]);

    //     $emails = EmailSubscription::select('email')->get()->pluck('email');
    //     $leadEmails = Lead::select('email')->get()->pluck('email');

    //     // Merge and remove duplicates
    //     $allEmails = $emails->merge($leadEmails)->unique();

    //     if ($allEmails->isEmpty()) {

    //         return back()->with('error', 'No email subscriptions found.');
    //     }

    //     $emailCount = $allEmails->count();

    //     $costPerEmail = 0.05;
    //     $totalCost = $emailCount * $costPerEmail;

    //     // Check if user has 'Business User' role and sufficient balance
    //     $user = auth()->user();
    //     if ($user->hasRole('Business User')) {
    //         if ($user->balance < $totalCost) {
    //             return back()->with('error', 'Your balance is too low. Please recharge your account.');
    //         }
    //     }

    //     $attach = null;
    //     if ($request->hasFile('attach')) {
    //         $attach = $request->file('attach')->store('attch', 'public');
    //     }

    //     DB::beginTransaction();

    //     try {
    //         foreach ($allEmails as $email) {
    //             SendEmailJob::dispatch($email, $request->subject, $request->body, $attach);
    //         }

    //         // Deduct balance if user has 'Business User' role
    //         if ($user->hasRole('Business User')) {
    //             $user->balance -= $totalCost;
    //             $user->save();
    //         }

    //         DB::commit();

    //         return redirect()->route('sub.index')->with('success', 'Emails are being sent.');
    //     } catch (\Exception $e) {

    //         DB::rollBack();
    //         Log::error('Failed to send emails: ' . $e->getMessage());
    //         return back()->with('error', 'Failed to send emails: ' . $e->getMessage());
    //     }
    // }


    // public function recharge(Request $request)
    // {
    //     $request->validate([
    //         'amount' => 'required|integer',
    //     ]);

    //     $amount = (int) $request->amount;

    //     // Calculate platform fee (2.5%)
    //     $platformFeePercentage = 0.025;
    //     $platformFee = $amount * $platformFeePercentage;

    //     $redirectUrl = route('recharge.stripe.checkout.success') . '?session_id={CHECKOUT_SESSION_ID}';

    //     $response = $this->stripe->checkout->sessions->create([
    //         'success_url' => $redirectUrl,
    //         'cancel_url' => route('recharge.stripe.checkout.cancel'), // Add your cancel URL
    //         'customer_email' => auth()->user()->email ?? 'demo@gmail.com',
    //         'payment_method_types' => ['link', 'card'],
    //         'line_items' => [
    //             [
    //                 'price_data' => [
    //                     'currency' => 'aed',
    //                     'product_data' => [
    //                         'name' => "Wallet",
    //                     ],
    //                     'unit_amount' => $amount * 100, // Stripe requires amount in cents
    //                 ],
    //                 'quantity' => 1
    //             ],
    //         ],
    //         'mode' => 'payment',
    //         'allow_promotion_codes' => true,
    //         'metadata' => [
    //             'request' => json_encode($request->all()),
    //         ],
    //         'payment_intent_data' => [
    //             'application_fee_amount' => (int)($platformFee * 100), // Platform fee in cents
    //             'transfer_data' => [
    //                 'destination' => env('STRIPE_CONNECTED_ACCOUNT_ID'), // Fetch from .env
    //             ],
    //         ],
    //     ]);

    //     if (isset($response->id) && $response->id != '') {
    //         return redirect($response->url);
    //     } else {
    //         return redirect()->route('cancel');
    //     }
    // }
    public function recharge(Request $request)
    {
        $request->validate([
            'amount' => 'required|integer',
        ]);

        $amount = (int) $request->amount;

        // Calculate platform fee (2.5%)
        $platformFeePercentage = 0.025;
        $platformFee = $amount * $platformFeePercentage;

        // Calculate total amount including platform fee
        $totalAmount = $amount + $platformFee;

        $redirectUrl = route('recharge.stripe.checkout.success') . '?session_id={CHECKOUT_SESSION_ID}';

        $response = $this->stripe->checkout->sessions->create([
            'success_url' => $redirectUrl,
            'cancel_url' => route('cancellation.policy'), // Add your cancel URL
            'customer_email' => auth()->user()->email ?? 'demo@gmail.com',
            'payment_method_types' => ['link', 'card'],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'aed',
                        'product_data' => [
                            'name' => "Wallet",
                        ],
                        'unit_amount' => $totalAmount * 100, // Stripe requires amount in cents
                    ],
                    'quantity' => 1
                ],
            ],
            'mode' => 'payment',
            'allow_promotion_codes' => true,
            'metadata' => [
                'request' => json_encode($request->all()),
            ],
        ]);

        if (isset($response->id) && $response->id != '') {
            return redirect($response->url);
        } else {
            return redirect()->route('cancel');
        }
    }

    public function stripeCheckoutSuccess(Request $request)
    {
        $sessionId = $request->input('session_id');

        // Retrieve the session from Stripe
        $session = $this->stripe->checkout->sessions->retrieve($sessionId);

        // Retrieve the original amount from metadata (if stored there)
        $originalAmount = json_decode($session->metadata->request, true)['amount'];

        // Calculate Stripe fee
        $stripeFeePercentage = 0.029;
        $stripeFixedFee = 1.00; // AED

        $stripeFee = ($originalAmount * $stripeFeePercentage) + $stripeFixedFee;
        $amountAfterFees = $originalAmount - $stripeFee;
        
        // Update the user's balance
        $user = auth()->user();
        $user->balance += $amountAfterFees;
        $user->save();

        return redirect()->route('user.wallet')->with('success', 'Balance updated successfully!');
    }


}
