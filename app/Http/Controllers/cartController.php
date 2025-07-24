<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\product;

class cartController extends Controller
{
    public function cart()
    {
        $cart = Cart::with('product')->where('user_id', Auth::id())->get();
        $total = $cart->sum(fn($item) => $item->product->price * $item->quantity);
        return view('cart', compact('cart', 'total'));
    }

    public function addtocart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $cartItem = Cart::where('user_id', Auth::id())
                        ->where('product_id', $request->product_id)
                        ->first();

        if ($cartItem) {
            $cartItem->increment('quantity');
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'quantity' => 1
            ]);
        }

        return redirect()->route('cart')->with('success', 'Added to cart');
    }

    public function update(Request $request)
    {
        Cart::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->update(['quantity' => $request->quantity]);

        return back();
    }

    public function remove($productid)
    {
        Cart::where('user_id', Auth::id())
            ->where('product_id', $productid)
            ->delete();

        return back();
    }

}
