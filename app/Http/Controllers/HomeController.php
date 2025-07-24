<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Ensure user is authenticated for all methods
        }

    public function home()
    {
        $categories = Category::all();
        $products = Product::paginate(5);
        return view('home', compact('categories', 'products'));
    }

    public function index()
    {
        $categories = Category::all();
        $products = Product::paginate(5);
        return view('category.index', compact('categories', 'products'));
    }

    public function review(Request $request)
    {
        $reviews = Review::all();
        return view('review', ['reviews'=>$reviews])->with('success','review added Successfully!');
    }


    public function storereview(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|min:3|max:20',
            'email' => 'required|email',
            'phone' => 'required|string|min:10|max:15',
            'subject' => 'required|string|min:3|max:100',
            'message' => 'required|string|min:3|max:1000',
        ]);
        

        Review::create($data);
    $reviews = Review::all();

    // تمرير المتغير للفيو
    return view('review', ['reviews' => $reviews])->with('success', 'review added Successfully!');
}    



    public function search(Request $request)
    {
        $search = $request->input('name');
        $products = Product::where('name','LIKE', "%$search%")->get();
        return view('product.index', [
            
            'products' => $products
        ]);
    }

    public function order()
    {
        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);
        return view('product.order',compact('cartItems', 'total'));

    }

    public function storeorder(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|min:3|max:20',
            'email' => 'required|email',
            'phone' => 'required|string|min:10|max:15',
            'address' => 'required|string|min:5|max:100',
            'note' =>'string'
        ]);
        $data['user_id'] = Auth::id();
        //dd($data);
        $order = order::create($data);

        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
        foreach ($cartItems as $item) {
            OrderDetail::create([
            'order_id'   => $order->id,
            'product_id' => $item->product_id,
            'quantity'   => $item->quantity,
            'price'      => $item->product->price,
        ]);
        }

        //Clear the cart after order is placed
        Cart::where('user_id', Auth::id())->delete();


    return redirect()->route('home')->with('success', 'تم إرسال الطلب بنجاح');

    }

    public function preOrder(){
        $orders = Order::with('orderDetails')->where('user_id', Auth::id())->get();
        return view ('product.pre-order', [
            'orders' => $orders
        ]);
    }
}