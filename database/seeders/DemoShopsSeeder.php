<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Business;
use App\Models\BusinessImage;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\TeamMember;
use App\Models\Feedback;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class DemoShopsSeeder extends Seeder
{
    private array $reviewerNames = [
        'Sarah Mitchell', 'James Anderson', 'Fatima Al Zaabi', 'David Chen',
        'Emily Watson', 'Omar Al Farsi', 'Jessica Brown', 'Ahmed Khan',
        'Olivia Taylor', 'Michael Scott', 'Layla Hassan', 'Ryan Cooper',
        'Sophia Martinez', 'Noah Williams', 'Mariam Saeed', 'Ethan Clark',
        'Grace Kim', 'Yusuf Ibrahim', 'Chloe Robinson', 'Daniel Lee',
        'Aisha Rahman', 'Lucas Turner',
    ];

    private array $reviewTexts = [
        'Absolutely loved the experience here. The staff were friendly and the results exceeded my expectations.',
        'Clean, professional, and the team really knows what they are doing. Will definitely be back!',
        'Booked an appointment and was in and out with amazing results. Highly recommend to anyone nearby.',
        'Great atmosphere and even better service. My go-to place from now on.',
        'The attention to detail was outstanding. Worth every penny.',
        'Friendly staff, relaxing environment, and top quality work. Five stars.',
        'I have tried a few places in the area and this is by far the best one.',
        'Booking was easy and the service itself was quick, professional, and high quality.',
        'Such a warm welcome and the final result looked exactly like what I asked for.',
        'A hidden gem! The team is talented and genuinely cares about their clients.',
        'Loved the vibe of the place and the staff made me feel so comfortable.',
        'Consistent quality every time I visit. Never disappointed.',
    ];

    private array $categories = [
        ['name' => 'Hair Styling', 'description' => 'Haircuts, styling and blowouts for all hair types'],
        ['name' => 'Hair Coloring', 'description' => 'Full color, highlights, balayage and creative color work'],
        ['name' => 'Barber Shop', 'description' => 'Classic and modern grooming for men'],
        ['name' => 'Nail Care', 'description' => 'Manicures, pedicures and nail art'],
        ['name' => 'Spa & Massage', 'description' => 'Relaxing massage and body treatments'],
        ['name' => 'Makeup & Beauty', 'description' => 'Professional makeup and beauty services'],
        ['name' => 'Skin Care', 'description' => 'Facials and skin treatments'],
    ];

    private array $shops = [
        [
            'name' => 'Glow & Co. Hair Studio',
            'about' => 'A modern hair studio in the heart of Dubai offering precision cuts, color, and styling from a team of award-winning stylists.',
            'city' => 'Dubai', 'state' => 'Dubai', 'country' => 'United Arab Emirates', 'country_code' => 'AE',
            'lat' => '25.2048', 'lng' => '55.2708',
            'images' => ['salon-1', 'hair-care-1', 'hair-styling-1'],
            'services' => [
                ['name' => "Women's Haircut & Style", 'cat' => 'Hair Styling', 'price' => 65, 'duration' => '60'],
                ['name' => "Men's Haircut", 'cat' => 'Hair Styling', 'price' => 35, 'duration' => '30'],
                ['name' => 'Full Hair Color', 'cat' => 'Hair Coloring', 'price' => 150, 'duration' => '120'],
                ['name' => 'Balayage Highlights', 'cat' => 'Hair Coloring', 'price' => 220, 'duration' => '150'],
                ['name' => 'Blowout & Styling', 'cat' => 'Hair Styling', 'price' => 50, 'duration' => '45'],
            ],
        ],
        [
            'name' => 'Serenity Spa & Wellness',
            'about' => 'An urban sanctuary offering therapeutic massage, facials, and body treatments designed to help you unwind and recharge.',
            'city' => 'Dubai', 'state' => 'Dubai', 'country' => 'United Arab Emirates', 'country_code' => 'AE',
            'lat' => '25.1972', 'lng' => '55.2744',
            'images' => ['spa-facial', 'spa-pedicure', 'massage-spa'],
            'services' => [
                ['name' => 'Swedish Massage', 'cat' => 'Spa & Massage', 'price' => 90, 'duration' => '60'],
                ['name' => 'Deep Tissue Massage', 'cat' => 'Spa & Massage', 'price' => 110, 'duration' => '60'],
                ['name' => 'Classic Facial', 'cat' => 'Skin Care', 'price' => 85, 'duration' => '50'],
                ['name' => 'Hot Stone Therapy', 'cat' => 'Spa & Massage', 'price' => 130, 'duration' => '75'],
                ['name' => 'Aromatherapy Massage', 'cat' => 'Spa & Massage', 'price' => 100, 'duration' => '60'],
            ],
        ],
        [
            'name' => "The Gentlemen's Barber Co.",
            'about' => 'A classic barbershop experience with modern grooming techniques, hot towel shaves, and precision fades.',
            'city' => 'Abu Dhabi', 'state' => 'Abu Dhabi', 'country' => 'United Arab Emirates', 'country_code' => 'AE',
            'lat' => '24.4539', 'lng' => '54.3773',
            'images' => ['barbershop', 'salon-3', 'hair-styling-2'],
            'services' => [
                ['name' => 'Classic Haircut', 'cat' => 'Barber Shop', 'price' => 30, 'duration' => '30'],
                ['name' => 'Beard Trim & Shape', 'cat' => 'Barber Shop', 'price' => 20, 'duration' => '20'],
                ['name' => 'Hot Towel Shave', 'cat' => 'Barber Shop', 'price' => 35, 'duration' => '30'],
                ['name' => 'Haircut & Beard Combo', 'cat' => 'Barber Shop', 'price' => 45, 'duration' => '45'],
                ['name' => "Kids' Haircut", 'cat' => 'Barber Shop', 'price' => 22, 'duration' => '25'],
            ],
        ],
        [
            'name' => 'Bloom Beauty & Makeup Studio',
            'about' => 'Specialists in bridal and editorial makeup, nail art, and lash extensions for every occasion.',
            'city' => 'Dubai', 'state' => 'Dubai', 'country' => 'United Arab Emirates', 'country_code' => 'AE',
            'lat' => '25.1124', 'lng' => '55.1990',
            'images' => ['makeup-application', 'makeup-brushes', 'makeup-products'],
            'services' => [
                ['name' => 'Bridal Makeup', 'cat' => 'Makeup & Beauty', 'price' => 180, 'duration' => '90'],
                ['name' => 'Everyday Glam Makeup', 'cat' => 'Makeup & Beauty', 'price' => 70, 'duration' => '45'],
                ['name' => 'Classic Manicure', 'cat' => 'Nail Care', 'price' => 35, 'duration' => '40'],
                ['name' => 'Gel Pedicure', 'cat' => 'Nail Care', 'price' => 45, 'duration' => '50'],
                ['name' => 'Eyelash Extensions', 'cat' => 'Makeup & Beauty', 'price' => 95, 'duration' => '60'],
            ],
        ],
        [
            'name' => 'Urban Edge Salon',
            'about' => 'A bold, trend-forward salon in New York known for creative color transformations and precision cutting.',
            'city' => 'New York', 'state' => 'New York', 'country' => 'United States', 'country_code' => 'US',
            'lat' => '40.7128', 'lng' => '-74.0060',
            'images' => ['hair-color-artistic', 'salon-2', 'salon-4-marble'],
            'services' => [
                ['name' => 'Creative Color Design', 'cat' => 'Hair Coloring', 'price' => 280, 'duration' => '180'],
                ['name' => 'Precision Haircut', 'cat' => 'Hair Styling', 'price' => 75, 'duration' => '45'],
                ['name' => 'Keratin Smoothing Treatment', 'cat' => 'Hair Styling', 'price' => 200, 'duration' => '120'],
                ['name' => 'Vivid Fashion Colors', 'cat' => 'Hair Coloring', 'price' => 250, 'duration' => '150'],
            ],
        ],
        [
            'name' => 'Curls & Coils Natural Hair Studio',
            'about' => 'A London studio dedicated to natural and textured hair care, from curl definition to deep conditioning.',
            'city' => 'London', 'state' => 'England', 'country' => 'United Kingdom', 'country_code' => 'GB',
            'lat' => '51.5074', 'lng' => '-0.1278',
            'images' => ['natural-hair-beauty', 'hair-care-1', 'salon-1'],
            'services' => [
                ['name' => 'Natural Curl Cut & Definition', 'cat' => 'Hair Styling', 'price' => 80, 'duration' => '60'],
                ['name' => 'Deep Conditioning Treatment', 'cat' => 'Hair Styling', 'price' => 55, 'duration' => '45'],
                ['name' => 'Silk Press', 'cat' => 'Hair Styling', 'price' => 95, 'duration' => '90'],
                ['name' => 'Scalp Treatment', 'cat' => 'Skin Care', 'price' => 60, 'duration' => '40'],
            ],
        ],
        [
            'name' => 'Tranquil Waters Day Spa',
            'about' => 'A tranquil escape offering couples massage, detox body treatments, and signature facials.',
            'city' => 'Dubai', 'state' => 'Dubai', 'country' => 'United Arab Emirates', 'country_code' => 'AE',
            'lat' => '25.0657', 'lng' => '55.1713',
            'images' => ['wellness-spa', 'spa-facial', 'massage-spa'],
            'services' => [
                ['name' => 'Couples Massage', 'cat' => 'Spa & Massage', 'price' => 220, 'duration' => '60'],
                ['name' => 'Detox Body Wrap', 'cat' => 'Spa & Massage', 'price' => 120, 'duration' => '60'],
                ['name' => 'Signature Facial', 'cat' => 'Skin Care', 'price' => 95, 'duration' => '60'],
                ['name' => 'Reflexology', 'cat' => 'Spa & Massage', 'price' => 75, 'duration' => '45'],
            ],
        ],
    ];

    private array $portraitPool = [
        'portrait-woman-1', 'portrait-woman-2', 'portrait-man-1', 'portrait-man-2',
        'portrait-woman-3', 'portrait-woman-4', 'portrait-woman-5', 'portrait-man-3',
        'portrait-woman-6',
    ];

    public function run(): void
    {
        $admin = User::whereHas('roles', fn ($q) => $q->where('name', 'Admin'))->first();

        if (! $admin) {
            $this->command->warn('No Admin user found, skipping demo shop seeding.');
            return;
        }

        $this->copyAssetFolder('shops');
        $this->copyAssetFolder('portraits');

        $businessRole = Role::firstOrCreate(['name' => 'Business User']);

        $categoryIds = [];
        foreach ($this->categories as $cat) {
            $category = ServiceCategory::firstOrCreate(
                ['name' => $cat['name'], 'created_by' => $admin->id],
                ['description' => $cat['description'], 'updated_by' => $admin->id]
            );
            $categoryIds[$cat['name']] = $category->id;
        }

        $reviewerIndex = 0;
        $portraitIndex = 0;

        foreach ($this->shops as $shopIndex => $shop) {
            $slug = Str::slug($shop['name']);
            $email = $slug . '@demo-shops.kimih.test';

            if (User::where('email', $email)->exists()) {
                continue;
            }

            $ownerPortrait = $this->portraitPool[$shopIndex % count($this->portraitPool)];

            $owner = User::create([
                'name' => $shop['name'] . ' Owner',
                'email' => $email,
                'password' => bcrypt('demo12345'),
                'phone' => '+97150' . rand(1000000, 9999999),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'image' => 'portraits/' . $ownerPortrait . '.jpg',
                'address' => $shop['city'] . ', ' . $shop['country'],
            ]);
            $owner->assignRole($businessRole);

            $business = Business::create([
                'user_id' => $owner->id,
                'business_name' => $shop['name'],
                'slug' => $slug,
                'about_us' => $shop['about'],
                'website' => null,
                'services' => collect($shop['services'])->pluck('name')->implode(', '),
                'team_size' => '2-5',
                'location' => $shop['city'] . ', ' . $shop['country'],
                'latitude' => $shop['lat'],
                'longitude' => $shop['lng'],
                'city' => $shop['city'],
                'state' => $shop['state'],
                'country' => $shop['country'],
                'country_code' => $shop['country_code'],
            ]);

            foreach ($shop['images'] as $img) {
                BusinessImage::create([
                    'business_id' => $business->id,
                    'image' => 'shops/' . $img . '.jpg',
                    'created_by' => $admin->id,
                    'updated_by' => $admin->id,
                ]);
            }

            foreach ($shop['services'] as $svc) {
                Service::create([
                    'service_name' => $svc['name'],
                    'service_type' => 'Fixed',
                    'service_category' => $categoryIds[$svc['cat']],
                    'available_for' => 'Everyone',
                    'service_description' => $svc['name'] . ' at ' . $shop['name'],
                    'online_bookings' => 'Yes',
                    'duration' => $svc['duration'],
                    'price_type' => 'Fixed',
                    'price' => $svc['price'],
                    'created_by' => $owner->id,
                    'updated_by' => $owner->id,
                ]);
            }

            for ($i = 0; $i < 2; $i++) {
                $portrait = $this->portraitPool[$portraitIndex % count($this->portraitPool)];
                $portraitIndex++;
                $memberName = $this->reviewerNames[($shopIndex * 3 + $i) % count($this->reviewerNames)];

                TeamMember::create([
                    'name' => $memberName,
                    'email' => Str::slug($memberName) . '.' . $shopIndex . $i . '@demo-shops.kimih.test',
                    'phone' => '+97150' . rand(1000000, 9999999),
                    'gender' => $i % 2 === 0 ? 'Female' : 'Male',
                    'job_title' => $i === 0 ? 'Senior Specialist' : 'Specialist',
                    'image' => 'portraits/' . $portrait . '.jpg',
                    'created_by' => $owner->id,
                    'updated_by' => $owner->id,
                ]);
            }

            for ($i = 0; $i < 3; $i++) {
                $reviewer = $this->reviewerNames[$reviewerIndex % count($this->reviewerNames)];
                $review = $this->reviewTexts[$reviewerIndex % count($this->reviewTexts)];
                $portrait = $this->portraitPool[$portraitIndex % count($this->portraitPool)];
                $reviewerIndex++;
                $portraitIndex++;

                Feedback::create([
                    'store_id' => $owner->id,
                    'name' => $reviewer,
                    'image' => 'portraits/' . $portrait . '.jpg',
                    'feedback' => $review,
                    'rating' => (string) rand(4, 5),
                    'status' => 1,
                    'created_by' => $admin->id,
                    'updated_by' => $admin->id,
                ]);
            }
        }

        $this->command->info('Demo shops seeded: ' . count($this->shops));
    }

    private function copyAssetFolder(string $folder): void
    {
        $source = database_path('seeders/assets/' . $folder);
        $destination = storage_path('app/public/' . $folder);

        if (! File::exists($destination)) {
            File::makeDirectory($destination, 0755, true);
        }

        foreach (File::files($source) as $file) {
            File::copy($file->getPathname(), $destination . '/' . $file->getFilename());
        }
    }
}
