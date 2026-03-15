<?php

namespace App\Http\Controllers;

use App\Models\ProductReview;
use Illuminate\Http\Request;

class ProductReviewController extends Controller
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
        $request->validate([
            'product_id' => 'required|integer',
            'user_id' => 'required|integer',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $review = ProductReview::create($request->all());

        return back()->with('success', 'Review Submited Successfully.');
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

    public function checkUserReview(Request $request)
    {
        $productId = $request->query('product_id');
        $userGiveReview = \App\Models\ProductReview::where('user_id', auth()->id())
            ->where('product_id', $productId)
            ->exists();

        return response()->json(['userGiveReview' => $userGiveReview]);
    }


    public function getReviews($productId)
    {
        $reviews = ProductReview::where('product_id', $productId)->get();
        return response()->json($reviews);
    }
}
