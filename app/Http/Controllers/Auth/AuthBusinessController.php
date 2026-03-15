<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Service;
use App\Models\Business;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use GuzzleHttp\Promise\Create;
use App\Jobs\CreateServicesJob;
use App\Models\ServiceCategory;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthBusinessController extends Controller
{
    public function index()
    {
        return view('admin.auth.business.login');
    }

    public function signUpIndex($email)
    {
        // dd($email);
        return view('admin.auth.business.sign-up', compact('email'));
    }

    public function signUp(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'phone' => 'required|string|min:10',
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($request->password);

        DB::transaction(function () use ($data) {
            $data['email_verified_at'] = now();
            $user = User::create($data);

            $business = Business::create([
                'user_id' => $user->id
            ]);
            if (!$business) {
                throw new \Exception('Failed to create business account');
            }

            Auth::login($user);

            $user->assignRole('Business User');
            // Fetch users who have the 'admin' role
            $admins = User::role('Admin')->first();
            $services = ServiceCategory::where('created_by', $admins->id)->get();
        });
        return redirect()->route('business.setup')->with('success', 'Business account created successfully');
    }

    public function setupAccountIndex()
    {
        // Fetch users who have the 'admin' role
        $admins = User::role('Admin')->first();
        $services = ServiceCategory::where('created_by', $admins->id)->get();
        return view('admin.auth.business.setup',compact('services'));
    }

    public function setupAccount(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'business_name' => 'required|string|max:255',
            'services' => 'nullable',
            'team_size' => 'required',
            'location' => 'required|string|max:255',
        ]);
        if($request->latitude && $request->longitude){
            $latitude = $request->latitude;
            $longitude = $request->longitude;
            try{
                $client = new \GuzzleHttp\Client();
                // $response = $client->request('GET', 'https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat='.$latitude.'&lon='.$longitude);
                $response = $client->request('GET', 'https://geocode.maps.co/reverse?lat='.$latitude.'&lon='.$longitude.'&api_key='.env('GEOCODE_API_KEY') );

                $data = json_decode($response->getBody());
                // dd($data);
                $request['city'] = $data->address->city ?? null;
                $request['country'] = $data->address->country ?? null;
                $request['country_code'] = $data->address->country_code ?? null;
                $request['state'] = $data->address->state ?? null;
            }
            catch(\Exception $e){
                // dd($e->getMessage());
                return redirect()->route('business.setup')->with('error', 'Failed to update location: ' . $e->getMessage());
            }
        }
        $this->createServices($request->services, Auth::id());
        $data = $request->all();
        $data['services'] = implode(',', $request->services);
        $data['slug'] = Str::slug($request->business_name);
        $business = Business::where('user_id', Auth::id())->first();
        $business->update($data);
        // User::find(Auth::id())->update(['name' => $request->business_name]);

        // dispatch(new CreateServicesJob($request->services, Auth::id())); //for creating services using queue
        return redirect()->route('dashboard')->with('success', 'Business account setup successfully');
    }

    public function createServices($services, $userId)
    {
        foreach($services as $service){
            $serviceCategory = ServiceCategory::find($service);

            $serviceCategory->created_by = $serviceCategory->updated_by = $userId;
            $newCategory = ServiceCategory::create($serviceCategory->toArray());
            if($serviceCategory->services){
                foreach ($serviceCategory->services as $value) {
                    $value['service_category'] = $newCategory->id;
                    $value['created_by'] = $value['updated_by'] = $userId;
                    Service::create($value->toArray());
                }
            }
        }

    }
}
