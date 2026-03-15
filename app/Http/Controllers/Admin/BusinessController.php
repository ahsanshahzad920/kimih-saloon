<?php

namespace App\Http\Controllers\Admin;

use App\Models\Business;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\BusinessImage;
use App\Http\Controllers\Controller;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        
        $request->validate([
            'business_name' => 'required',
            'location' => 'required',
            'image' => 'nullable|array|max:3',
            'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'image.max' => 'You can only upload 3 images.'
        ]);
        // dd($data);
        if($request->latitude && $request->longitude){
            $latitude = $request->latitude;
            $longitude = $request->longitude;
            try{
                $client = new \GuzzleHttp\Client();
                $response = $client->request('GET', 'https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat='.$latitude.'&lon='.$longitude);
                $data = json_decode($response->getBody());
                // dd($data);
                $request['city'] = $data->address->city ?? null;
                $request['country'] = $data->address->country ?? null;
                $request['country_code'] = $data->address->country_code ?? null;
                $request['state'] = $data->address->state ?? null;
            }
            catch(\Exception $e){
                return redirect()->route('profile.index')->with('error', 'Failed to update location: ' . $e->getMessage());
            }
        }
        $data = $request->all();
        // dd($data);
        $business = Business::where('user_id', $id)->first();
        if($request->hasFile('image'))
        {
            $business->images()->delete();
            foreach ($request->file('image') as $image)
            {
                // if(file_exists(public_path($image)))
                // {
                //     unlink(public_path($image));
                // }
                $image_name = rand(111111,999999).'-'.time().'.'.$image->extension();
                $image->storeAs('public/business/image',$image_name);
                $image_path = 'business/image/'.$image_name;
                BusinessImage::create([
                    'business_id' => $business->id,
                    'image' => $image_path,
                    'created_by' => auth()->id(),
                    'updated_by' => auth()->id(),
                ]);
            }
        }
        $data['slug'] = Str::slug($data['business_name']);
        $business->update($data);
        return redirect()->route('profile.index')->with('success', 'Business account updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
