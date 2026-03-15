<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Service;
use App\Models\Business;
use App\Models\TeamMember;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sale;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create($slug, $service_id = null)
    {
        $user = User::whereHas('roles', function ($query) {
            $query->where('name', 'Business User');
        })->whereHas('businessUser', function ($query) use ($slug) {
            $query->where('slug', $slug);
        })->first();

        if (!$user) {
            // Handle the case where the user is not found
            abort(404, 'User not found');
        }

        $firstMember = $user->teamMember ? $user->teamMember->first() : null;
        $schedules = $firstMember && $firstMember->schedules ? $firstMember->schedules->toArray() : [];

        $time_slots = [];

        // foreach ($schedules as $day) {
        //     if ($day['is_off'] == 0) {
        //         $time_slots[$day['day_of_week']] = generateTimeSlots($day['start_time'], $day['end_time']);
        //     } else {
        //         $time_slots[$day['day_of_week']] = [];
        //     }
        // }
        // $todayName = date('l');
        // // dd($todayName);
        // foreach ($schedules as $day) {
        //     if($day['day_of_week'] == $todayName){
        //         if ($day['is_off'] == 0) {
        //             $time_slots[$day['day_of_week']] = generateTimeSlots($day['start_time'], $day['end_time']);
        //         } else {
        //             $time_slots[$day['day_of_week']] = [];
        //         }
        //     }
        // }


        // Get the current day of the week
        $current_day = date('l');

        // Find the current day index in the schedule array
        $current_day_index = array_search($current_day, array_column($schedules, 'day_of_week'));

        // Rearrange the schedule array to start from the current day
        $reordered_schedule = array_merge(
            array_slice($schedules, $current_day_index),
            array_slice($schedules, 0, $current_day_index)
        );

        // Generate the time slots
        $time_slots = [];

        $dayNames = $this->getSevenDayNamesStartFromToday();


        // Create an associative array to track existing days
        $existingDays = [];
        foreach ($reordered_schedule as $item) {
            $existingDays[$item['day_of_week']] = $item;
        }

        // Initialize a new array for the updated schedule
        $newSchedule = [];

        // Add missing days at their corresponding positions
        foreach ($dayNames as $day) {
            if (isset($existingDays[$day])) {
                // Add the existing entry
                $newSchedule[] = $existingDays[$day];
            } else {
                // Add a new array for the missing day
                $newEntry = [
                    'day_of_week' => $day,
                    'start_time' => '09:00',
                    'end_time' => '17:00',
                    'is_off' => 1,
                ];
                $newSchedule[] = $newEntry;
            }
        }


        foreach ($newSchedule as $day) {
            if ($day['is_off'] == 0) {
                $time_slots[] = $this->generateTimeSlots($day['start_time'], $day['end_time']);
            } else {
                $time_slots[] = [];
            }
        }

        // dd($time_slots);

        return view('user.booking.index', compact('user', 'time_slots'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        // // dd($data);
        // $data['service_ids'] = implode(',', $data['services']);
        // $data['start'] = date('Y-m-d H:i:s', strtotime($data['start']));
        // $data['end'] = date('Y-m-d H:i:s', strtotime($data['end']));
        // $data['status'] = 'Booked';
        // $data['payment_status'] = 'unpaid';
        // $data['created_by'] = $data['business_id'];
        // $data['updated_by'] = $data['business_id'];
        // $data['grand_total'] = 0;

        // $data['ref'] = 'AP-' . rand(111111, 999999);
        // // dd($data);

        // $appointment = Appointment::create($data);

        // $services = $request->services;

        // foreach ($services as $service) {
        //     $service = Service::find($service);
        //     $appointment->services()->create([
        //         'service_id' => $service->id,
        //         'price' => $service->price ?? 0
        //     ]);
        //     $data['grand_total'] += $service->price;
        // }
        // $g_total = $this->taxCalculate($data['grand_total']);

        // $appointment->update(['grand_total' => $g_total]);

        // $user = User::find(auth()->id());

        // // Check if the user has enough balance
        // if ($user->balance >= $g_total) {
        //     // Decrement the grand total from the user's balance
        //     $new_balance = $user->balance - $g_total;

        //     // Update the user's balance in the database
        //     $user->balance = $new_balance;
        //     $user->save();
        // } else {
        //     // Handle the case where the user does not have enough balance
        //     // For example, you can throw an exception or return an error response
        //     return response()->json(['error' => 'Insufficient balance'], 400);
        // }


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

        $user = User::find(auth()->id());

        if ($user->balance >= $g_total) {
            // Decrement the grand total from the user's balance
            $new_balance = $user->balance - $g_total;

            // Update the user's balance in the database
            $user->balance = $new_balance;
            $user->save();
        }

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
            ]);
        }

        return response()->json(['status' => 200, 'message' => 'Appointment booked successfully']);
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
        //
    }


    public function getSevenDayNamesStartFromToday()
    {
        // Get the current date
        $currentDate = Carbon::now();

        // Initialize an empty array to store day names
        $dayNames = [];

        // Loop through the next 7 days
        for ($i = 0; $i < 7; $i++) {
            $dayName = $currentDate->format('l'); // Full day name (e.g., "Monday")
            $dayNames[] = $dayName;
            $currentDate->addDay(); // Move to the next day
        }

        return $dayNames;
    }

    public function generateTimeSlots($start_time, $end_time, $interval = '30 minutes')
    {

        $start = strtotime($start_time);
        $end = strtotime($end_time);
        $slots = [];

        while ($start <= $end) {
            $slots[] = date('H:i', $start);
            $start = strtotime($interval, $start);
        }

        return $slots;
    }

    public function getMemberTimeSlots(Request $request)
    {
        // dd($request->all());
        $data = $request->all();
        $member = TeamMember::find($data['member_id']);

        $schedules = $member->schedules->toArray();

        // Get the current day of the week
        $current_day = date('l');

        // Find the current day index in the schedule array
        $current_day_index = array_search($current_day, array_column($schedules, 'day_of_week'));

        // Rearrange the schedule array to start from the current day
        $reordered_schedule = array_merge(
            array_slice($schedules, $current_day_index),
            array_slice($schedules, 0, $current_day_index)
        );

        // Generate the time slots
        $time_slots = [];

        $dayNames = $this->getSevenDayNamesStartFromToday();
        // Create an associative array to track existing days
        $existingDays = [];
        foreach ($reordered_schedule as $item) {
            $existingDays[$item['day_of_week']] = $item;
        }

        // Initialize a new array for the updated schedule
        $newSchedule = [];

        // Add missing days at their corresponding positions
        foreach ($dayNames as $day) {
            if (isset($existingDays[$day])) {
                // Add the existing entry
                $newSchedule[] = $existingDays[$day];
            } else {
                // Add a new array for the missing day
                $newEntry = [
                    'day_of_week' => $day,
                    'start_time' => '09:00',
                    'end_time' => '17:00',
                    'is_off' => 1,
                ];
                $newSchedule[] = $newEntry;
            }
        }


        foreach ($newSchedule as $day) {
            if ($day['is_off'] == 0) {
                $time_slots[] = $this->generateTimeSlots($day['start_time'], $day['end_time']);
            } else {
                $time_slots[] = [];
            }
        }

        return response()->json(['status' => 200, 'time_slots' => $time_slots]);
    }

    protected function taxCalculate($originalAmount)
    {
        // Constants for fees
        $percentageFee = 2.5 / 100;
        $stripeFee = 1;
        $textFee = 0.15;
        $emailFee = 0.05;

        // Calculate fees
        $percentageFeeAmount = $originalAmount * $percentageFee;
        $totalFees = $percentageFeeAmount + $stripeFee + $textFee + $emailFee;

        // Calculate total amount
        $totalAmount = $originalAmount + $totalFees;

        return (int)$totalAmount;
    }
}
