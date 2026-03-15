<?php

namespace App\Jobs;

use App\Models\Service;
use Illuminate\Bus\Queueable;
use App\Models\ServiceCategory;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CreateServicesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public array $services, public int $userId)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach($this->services as $service){
            $serviceCategory = ServiceCategory::find($service);

            $serviceCategory->created_by = $serviceCategory->updated_by = $this->userId;
            $newCategory = ServiceCategory::create($serviceCategory->toArray());
            if($serviceCategory->services){
                foreach ($serviceCategory->services as $value) {
                    $value['service_category'] = $newCategory->id;
                    $value['created_by'] = $value['updated_by'] = $this->userId;
                    Service::create($value->toArray());
                }
            }
        }
    }
}
