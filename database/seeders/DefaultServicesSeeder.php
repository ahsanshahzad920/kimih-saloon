<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\User;
use Illuminate\Database\Seeder;

class DefaultServicesSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::whereHas('roles', fn ($q) => $q->where('name', 'Admin'))->first();

        if (! $admin) {
            $this->command->warn('No Admin user found, skipping default services seeding.');
            return;
        }

        $path = database_path('seeders/data/pakistan_services.json');

        if (! file_exists($path)) {
            $this->command->warn('pakistan_services.json not found, skipping default services seeding.');
            return;
        }

        $data = json_decode(file_get_contents($path), true);

        foreach ($data['categories'] ?? [] as $cat) {
            $category = ServiceCategory::where('name', $cat['category'])
                ->where('created_by', $admin->id)
                ->whereNull('default_category_id')
                ->first();

            if (! $category) {
                $this->command->warn("Category '{$cat['category']}' not found among admin categories, skipping its services.");
                continue;
            }

            foreach ($cat['services'] ?? [] as $svc) {
                Service::firstOrCreate(
                    [
                        'service_name' => $svc['name'],
                        'service_category' => $category->id,
                        'created_by' => $admin->id,
                    ],
                    [
                        'default_service_id' => null,
                        'is_active' => true,
                        'service_type' => $category->name,
                        'available_for' => $this->mapGender($svc['gender'] ?? null),
                        'aftercare_description' => null,
                        'service_description' => $svc['name_ur'] ?? null,
                        'online_bookings' => 0,
                        'team_member' => null,
                        'team_memeber_commission' => null,
                        'duration' => $svc['duration_min'] ?? null,
                        'price_type' => 'Fixed',
                        'price' => $svc['price_min_pkr'] ?? 0,
                        'notify' => 0,
                        'notify_count' => 0,
                        'notify_days' => 0,
                        'sales_tax' => null,
                        'updated_by' => $admin->id,
                    ]
                );
            }
        }
    }

    private function mapGender(?string $gender): string
    {
        return match ($gender) {
            'Men' => 'Male',
            'Women' => 'Female',
            default => 'Everyone',
        };
    }
}
