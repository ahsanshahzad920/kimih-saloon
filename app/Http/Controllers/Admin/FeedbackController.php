<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use GuzzleHttp\Client;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $feedbacks = Feedback::all();
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'Business User');
        })->whereHas('businessUser', function ($query) {
            $query->where('business_name', '!=', null);
        })->orderBy('created_at', 'desc')->get();
        // $users = $users ? $users:collect();
        $users->load('businessUser');
        // dd($users->businessUser);

        return view('admin.feedback.index', compact('feedbacks', 'users'));
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
        // dd($request->route()->getName());
        $request->validate([
            'name' => 'required',
            'image' => 'nullable',
            'feedback' => 'required',
            'rating' => 'required',
        ]);
        $data = $request->all();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->extension();
            $destinationPath = public_path('/uploads/feedback/');
            $image->move($destinationPath, $name);
            $data['image'] = "/uploads/feedback/" . $name;
        }

        $data['created_by'] = auth()->id();
        $data['updated_by'] = auth()->id();

        Feedback::create($data);

        if ($request->route()->getName() === 'cutomer.feedback.store')
            return redirect()->route('index')->with('success', 'Feedback given successfully.');
        else
            return redirect()->route('feedback.index')->with('success', 'Feedback created successfully.');
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
        // dd($request->route()->getName());
        $request->validate([
            'name' => 'required',
            'feedback' => 'required',
            'rating' => 'required',
        ]);
        $data = $request->all();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/feedback/');
            $image->move($destinationPath, $name);
            $data['image'] = "/uploads/feedback/" . $name;
        }
        $feedback = Feedback::find($id);
        $feedback->update($data);

        if ($request->route()->getName() === 'cutomer.feedback.update')
            return redirect()->route('cutomer.feedback.index')->with('success', 'Feedback updated successfully.');
        else
            return redirect()->route('feedback.index')->with('success', 'Feedback updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $feedback = Feedback::find($id);
        $feedback->delete();
        // return redirect()->route('feedback.index')->with('success','Feedback deleted successfully.');
        return response()->json(['status' => 200, 'success' => 'Feedback deleted successfully.']);
    }

    public function change_status(Request $request)
    {
        // dd($category->status );
        $feedback = Feedback::find($request->id);
        $status = $feedback->status;
        if ($feedback->status == 1) {
            $feedback->status = 0;
        } else {
            $feedback->status = 1;
        }
        $feedback->save();
        return response()->json(['status' => 200, 'message' => 'Feedback status changed successfully.']);
    }


    public function frontEndShowReviews()
    {
        $client = new Client();

        $url = 'https://serpapi.com/search';
        $params = [
            'engine' => 'google_maps_reviews',
            // 'data_id' => 217419116,
            'data_id' => 192647086,
            'api_key' => 'c493d3d921eda848a4842e95de85d3647a3379d990bdef50b10b18b8ef838d9e',
        ];

        $response = $client->get($url, ['query' => $params]);

        return json_decode($response->getBody(), true);
    }

    public function showUserFeedback()
    {
        $feedbacks = Feedback::where('created_by', auth()->id())->get();
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'Business User');
        })->whereHas('businessUser', function ($query) {
            $query->where('business_name', '!=', null);
        })->orderBy('created_at', 'desc')->get();
        // $users = $users ? $users:collect();
        $users->load('businessUser');
        // dd($users->businessUser);
        return view('user.customer-feedback.index', compact('feedbacks', 'users'));
    }
}
