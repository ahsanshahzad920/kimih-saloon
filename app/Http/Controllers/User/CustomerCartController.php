<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\AddToCart;
use Illuminate\Http\Request;

class CustomerCartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

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
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1',
            'shop_id' => 'nullable|integer',
        ]);

        $data = [
            'user_id' => auth()->id(),
            'product_id' => $validated['product_id'],
            'quantity' => $validated['quantity'] ?? 1,
            'shop_id' => $validated['shop_id'] ?? null,
        ];

        $cart = AddToCart::create($data);
        $cart->load('product.images');
        return response()->json(['status' => 200, 'message' => 'Product added to cart successfully', 'cart' => $cart]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cart = AddToCart::where('id', $id)->where('user_id', auth()->id())->first();
        if ($cart) {
            $cart->delete();
            return response()->json(['status' => 200, 'message' => 'Product removed from cart successfully']);
        }
        return response()->json(['status' => 404, 'message' => 'Cart item not found'], 404);
    }
}
