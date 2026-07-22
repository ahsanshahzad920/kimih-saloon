<?php

namespace App\Http\Controllers\User;

use App\Models\Home;
use App\Models\User;
use App\Models\Service;
use App\Models\Feedback;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use App\Models\ServiceCategory;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Models\Plan;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'Business User');
        })->whereHas('businessUser', function ($query) {
            $query->where('business_name', '!=', null);
        })->with(['businessUser.images', 'feedback', 'services'])->latest()->take(6)->get();

        $admin = Role::where('name', 'Admin')->first();
        $admin = $admin ? $admin->users->first() : collect();

        $serviceCategory = ServiceCategory::where('created_by', $admin->id)->get();

        // $businessRole = Role::where('name', 'Business User')->first();
        // $users = $businessRole ? $businessRole->users : collect();
        $home = Home::first();
        $feedbacks = Feedback::where('status', 1)->latest()->get();
        $plans = Plan::with('planServices')->get();

        return view('user.index', compact('users', 'serviceCategory', 'home', 'feedbacks', 'plans'));
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
        //
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

    public function shopDetails($slug)
    {
        $user = User::whereHas('roles', function ($query) {
            $query->where('name', 'Business User');
        })->whereHas('businessUser', function ($query) use ($slug) {
            $query->where('slug', $slug);
        })->first();

        $services = Service::where('created_by', $user->id)->get();
        $team_members = TeamMember::where('created_by', $user->id)->get();
        $feedbacks = Feedback::where('store_id', $user->id)->where('status', 1)->latest()->get();

        $nearByUsers = User::whereHas('roles', function ($query) {
            $query->where('name', 'Business User');
        })->whereHas('businessUser', function ($query) use ($user) {
            $query->where('country', $user->businessUser->country);
        })->where('id', '!=', $user->id)->limit(10)->get();

        // dd($nearByUsers);
        return view('user.shop.details', compact('user', 'services', 'team_members', 'feedbacks', 'nearByUsers'));
    }

    // public function searchShop(Request $request){
    //     // dd($request->all());
    //     $data = $request->all();
    //     // dd($data);

    //     $user = User::whereHas('roles', function ($query) {
    //         $query->where('name', 'Business User');
    //     })->whereHas('businessUser',function($query) {
    //         $query->where('business_name','!=',null);
    //     });
    //     if($data['service'] != ''){
    //         $user->whereHas('serviceCategory',function($query) use ($data) {
    //             $query->where('name','like','%'.$data['service'].'%');
    //         });
    //     }
    //     if($data['location'] != ''){
    //         $user->whereHas('businessUser',function($query) use ($data) {
    //             $query->where('location','like','%'.$data['location'].'%');
    //         });
    //     }

    //     $users = $user->get();
    //     $users->load('businessUser');
    //     // $shopLocations = $users->map(function($user) {
    //     //     return [
    //     //         'shop' => $user->businessUser,
    //     //         'shop_image' => !empty($user->businessUser->images) ? asset('storage/' . $user->businessUser->images[0]['image']) : 'https://via.placeholder.com/150',
    //     //         'latitude' => $user->businessUser->latitude,
    //     //         'longitude' => $user->businessUser->longitude,
    //     //     ];
    //     // });
    //     $shopLocations = $users->map(function($user) {
    //         $images = $user->businessUser->images;
    //         $firstImage = 'https://via.placeholder.com/150'; // Default placeholder image

    //         if (is_array($images) && isset($images[0])) {
    //             $firstImage = asset('storage/' . $images[0]['image']);
    //         } elseif ($images instanceof Illuminate\Support\Collection && $images->isNotEmpty()) {
    //             $firstImage = asset('storage/' . $images->first()['image']);
    //         }

    //         return [
    //             'shop' => $user->businessUser,
    //             'shop_image' => $firstImage,
    //             'latitude' => $user->businessUser->latitude,
    //             'longitude' => $user->businessUser->longitude,
    //         ];
    //     });
    //     // dd($shopLocations);
    //     return view('user.shop.search',compact('users','shopLocations'));

    // }

    // public function searchShop(Request $request)
    // {
    //     // Get request data
    //     $data = $request->all();

    //     // Initialize the query builder
    //     $userQuery = User::whereHas('roles', function ($query) {
    //         $query->where('name', 'Business User');
    //     })->whereHas('businessUser', function ($query) {
    //         $query->where('business_name', '!=', null);
    //     });

    //     // Apply filters if provided
    //     if (!empty($data['service'])) {
    //         $userQuery->whereHas('serviceCategory', function ($query) use ($data) {
    //             $query->where('name', 'like', '%' . $data['service'] . '%');
    //         });
    //     }

    //     if (!empty($data['location'])) {
    //         // Apply location filter if provided
    //         $userQuery->whereHas('businessUser', function ($query) use ($data) {
    //             $query->where('location', 'like', '%' . $data['location'] . '%');
    //         });
    //     } else {

    //         // If location is not provided, use IP address to get geolocation
    //         $ip = $request->ip();
    //         $response = Http::get("http://ipinfo.io/{$ip}/json");
    //         $locationData = $response->json();

    //         // Extract latitude and longitude from IP geolocation
    //         $location = $locationData['loc'] ?? '31.5204,74.3587'; // Default to Lahore if location not found
    //         list($latitude, $longitude) = explode(',', $location);

    //         // Use the latitude and longitude to find nearby shops
    //         $userQuery = User::whereHas('roles', function ($query) {
    //             $query->where('name', 'Business User');
    //         })->whereHas('businessUser', function ($query) use ($latitude, $longitude) {
    //             // Adjust the radius as needed (50 km in this example)
    //             $query->whereRaw("ST_Distance_Sphere(point(longitude, latitude), point(?, ?)) < ?", [$longitude, $latitude, 50000]);
    //         });
    //     }

    //     // Fetch users based on the query
    //     $users = $userQuery->get();

    //     // Load related data
    //     $users->load('businessUser');

    //     // Map the results
    //     $shopLocations = $users->map(function ($user) {
    //         $images = $user->businessUser->images;
    //         $firstImage = 'https://via.placeholder.com/150';

    //         if (is_array($images) && isset($images[0])) {
    //             $firstImage = asset('storage/' . $images[0]['image']);
    //         } elseif ($images instanceof Illuminate\Support\Collection && $images->isNotEmpty()) {
    //             $firstImage = asset('storage/' . $images->first()['image']);
    //         }

    //         return [
    //             'shop' => $user->businessUser,
    //             'shop_image' => $firstImage,
    //             'latitude' => $user->businessUser->latitude,
    //             'longitude' => $user->businessUser->longitude,
    //         ];
    //     });

    //     // Return view
    //     return view('user.shop.search', compact('users', 'shopLocations'));
    // }
    public function searchShop(Request $request)
    {
        // Get request data
        $data = $request->all();

        // Initialize the query builder
        $userQuery = User::whereHas('roles', function ($query) {
            $query->where('name', 'Business User');
        })->whereHas('businessUser', function ($query) {
            $query->where('business_name', '!=', null);
        });

        // Apply filters if provided
        if (!empty($data['service'])) {
            $userQuery->whereHas('serviceCategory', function ($query) use ($data) {
                $query->where('name', 'like', '%' . $data['service'] . '%');
            });
        }

        if (!empty($data['location'])) {
            // Apply location filter if provided
            $userQuery->whereHas('businessUser', function ($query) use ($data) {
                $query->where('location', 'like', '%' . $data['location'] . '%');
            });
            $ip = $request->ip();
            $response = Http::get("http://ipinfo.io/{$ip}/json");
            $locationData = $response->json();

            $country = $locationData['country'] ?? 'AE'; // Default to United Arab Emirates (AE) if country not found
            $city = $locationData['city'] ?? 'Dubai'; // Default to Dubai if city not found

        } else {
            // If location is not provided, use IP address to get geolocation
            $ip = $request->ip();
            $response = Http::get("http://ipinfo.io/{$ip}/json");
            $locationData = $response->json();

            $country = $locationData['country'] ?? 'AE'; // Default to United Arab Emirates (AE) if country not found
            $city = $locationData['city'] ?? 'Dubai'; // Default to Dubai if city not found
            

            // First, try to find users in the same city
            $userQuery = User::whereHas('roles', function ($query) {
                $query->where('name', 'Business User');
            })->whereHas('businessUser', function ($query) use ($country, $city) {
                $query->where('country_code', $country)
                      ->where('city', $city);
            });
        }

        // Fetch users based on the query
        $users = $userQuery->get();
        // If no users found in the same city, then try to find users in the same country
        if ($users->isEmpty()) {
            $userQuery = User::whereHas('roles', function ($query) {
                $query->where('name', 'Business User');
            })->whereHas('businessUser', function ($query) use ($country) {
                $query->where('country_code', $country);
            });

            // Execute the query and get the results
            $users = $userQuery->get();
        }
        // Load related data
        $users->load('businessUser','feedback');
        // dd($users);

        // Map the results
        $shopLocations = $users->map(function ($user) {
            $images = $user->businessUser->images;
            $firstImage = 'https://via.placeholder.com/150';

            if (is_array($images) && isset($images[0])) {
                $firstImage = asset('storage/' . $images[0]['image']);
            } elseif ($images instanceof Illuminate\Support\Collection && $images->isNotEmpty()) {
                $firstImage = asset('storage/' . $images->first()['image']);
            }

            return [
                'shop' => $user->businessUser,
                'shop_image' => $firstImage,
                'latitude' => $user->businessUser->latitude,
                'longitude' => $user->businessUser->longitude,
                'feedback' => $user->feedback->count(),
            ];
        });

        // dd($shopLocations);

        // Return view
        return view('user.shop.search', compact('users', 'shopLocations'));
    }
}
