<?php

namespace Database\Seeders;

use App\Models\ServiceCategory;
use App\Models\User;
use Illuminate\Database\Seeder;

class DefaultServiceCategoriesSeeder extends Seeder
{
    private array $categories = [
        ['name' => 'Beauty & Face', 'description' => 'Facials, bleach, threading, waxing and whitening treatments'],
        ['name' => 'Hair & Styles', 'description' => 'Haircuts, coloring, keratin, hair spa and styling'],
        ['name' => 'Nails', 'description' => 'Manicure, pedicure, nail art and extensions'],
        ['name' => 'Barber / Men\'s Grooming', 'description' => 'Haircut, beard trim, shaving and grooming for men'],
        ['name' => 'Spa & Massage', 'description' => 'Body massage, scrub, polish and aromatherapy'],
        ['name' => 'Bridal & Makeup', 'description' => 'Bridal makeup, party makeup, mehndi and event hairstyling'],
        ['name' => 'Skin Care', 'description' => 'Laser hair removal, acne treatment, whitening and dermaplaning'],
        ['name' => 'Lashes & Brows', 'description' => 'Eyelash extensions, brow lamination and eyebrow tinting'],
    ];

    public function run(): void
    {
        $admin = User::whereHas('roles', fn ($q) => $q->where('name', 'Admin'))->first();

        if (! $admin) {
            $this->command->warn('No Admin user found, skipping default service category seeding.');
            return;
        }

        foreach ($this->categories as $category) {
            ServiceCategory::firstOrCreate(
                ['name' => $category['name'], 'created_by' => $admin->id],
                ['description' => $category['description'], 'updated_by' => $admin->id]
            );
        }
    }
}
