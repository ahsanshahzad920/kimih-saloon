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
            'image' => 'nullable|array|max:15',
            'image.*' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp,avif|max:10240'
        ], [
            'image.max' => 'You can upload up to 15 images.',
            'image.*.file' => 'Each uploaded file must be a valid file.',
            'image.*.mimes' => 'Allowed image formats: JPEG, PNG, JPG, GIF, WEBP, AVIF.'
        ]);

        if($request->latitude && $request->longitude){
            $latitude = $request->latitude;
            $longitude = $request->longitude;
            try{
                $client = new \GuzzleHttp\Client();
                $response = $client->request('GET', 'https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat='.$latitude.'&lon='.$longitude);
                $data = json_decode($response->getBody());
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
        $business = Business::where('user_id', $id)->first();
        if($request->hasFile('image'))
        {
            foreach ($request->file('image') as $image)
            {
                $ext = strtolower($image->getClientOriginalExtension());
                if (empty($ext)) {
                    $ext = $image->extension() ?: 'jpg';
                }
                $image_name = rand(111111,999999).'-'.time().'.'.$ext;
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
     * Delete an individual business image.
     */
    public function deleteImage($id)
    {
        $img = BusinessImage::find($id);
        if ($img) {
            $path = storage_path('app/public/' . $img->image);
            if (file_exists($path)) {
                @unlink($path);
            }
            $img->delete();
            return response()->json(['status' => true, 'message' => 'Image deleted successfully']);
        }
        return response()->json(['status' => false, 'message' => 'Image not found'], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
