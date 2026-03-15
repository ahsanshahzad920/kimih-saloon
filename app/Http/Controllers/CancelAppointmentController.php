<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Reply;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\User;
use Illuminate\Http\Request;

class CancelAppointmentController extends Controller
{
    public function cancel(Request $request)
    {
        if ($request->has('appointment_id')) {
            $saleID = SaleItem::where('item_id', $request->appointment_id)->first('sale_id');

            if ($saleID) {
                $sale = Sale::find($saleID->sale_id);

                if ($sale) {
                    $appointment = Appointment::find($request->appointment_id);

                    if ($appointment) {

                        $user = User::find(auth()->id());
                        $newBalance = $user->balance + $appointment->grand_total;
                        $user->update(['balance' => $newBalance]);

                        $appointment->delete();
                        $sale->delete();

                        return back();
                    } else {
                        return back()->withErrors(['appointment' => 'Appointment not found.']);
                    }
                } else {
                    return back()->withErrors(['sale' => 'Sale not found.']);
                }
            } else {
                return back()->withErrors(['saleID' => 'Sale ID not found.']);
            }
        }
    }
}
