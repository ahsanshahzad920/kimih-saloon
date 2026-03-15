<?php

namespace App\Observers;

use App\Models\Sale;
use App\Models\Appointment;

class SaleObserver
{
    /**
     * Handle the Sale "created" event.
     */
    public function created(Sale $sale)
    {
        // if($sale->cash_received > 0){
        //     foreach ($sale->items as $item) {
        //         if ($item->type == 'appointment') {
        //             $appointment = Appointment::find($item->item_id);
        //             if ($appointment) {
        //                 $appointment->status = 'Completed';
        //                 $appointment->save();
        //             }
        //         }
        //     }
        // }
    }

    /**
     * Handle the Sale "updated" event.
     */
    public function updated(Sale $sale): void
    {
        //
    }

    /**
     * Handle the Sale "deleted" event.
     */
    public function deleted(Sale $sale): void
    {
        //
    }

    /**
     * Handle the Sale "restored" event.
     */
    public function restored(Sale $sale): void
    {
        //
    }

    /**
     * Handle the Sale "force deleted" event.
     */
    public function forceDeleted(Sale $sale): void
    {
        //
    }
}
