<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class productController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products = Product::paginate(5);

        // Return the view with categories
        return view('product.index', compact('categories', 'products'));
    }

    public function create()
    {
        // Pass the categories to the view
        $categories = Category::all();
        return view('product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|min:3|max:20',
            'description' => 'required|string|min:3|max:1000',
            'price' => 'required|numeric|min:0', 
            'quantity' => 'required|integer|min:1',
            'imagepath' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required|exists:categories,id'

        ]);
        
        $data['imagepath'] = $request->file('imagepath')->store('photos','public');


        
        product::create($data);
        return redirect('product')->with('success','product Created Successfully!');
    }

    public function edit(Product $product)
    {
        
        $categories = Category::all();
        return view('product.edit',compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, product $product)
    {
        $data = $request->validate([
            'name' => 'required|string|min:3|max:20',
            'description' => 'required|string|min:3|max:1000',
            'price' => 'required|numeric|min:0', 
            'quantity' => 'required|integer|min:1',
            'imagepath' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required|exists:categories,id'
        ]);
        

        if ($request->hasFile('imagepath')) {
            if ($product->imagepath) {
                Storage::disk('public')->delete($product->imagepath);
            }
            $data['imagepath'] = $request->file('imagepath')->store('photo','public');
        }   
        //$data['banner_image'] = $request->file('banner_image')->store('blog','public');
        $product->update($data);
        
        return redirect('category')->with('success','Blog Updated Successfully!');
    }



    public function show(product $product)
    {
        $product =product::with('Category')->findOrFail($product->id);
        $relatedproducts = product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(3)
            ->get();
            //dd($product);
        return view('product.show', compact('product', 'relatedproducts'));
    }




    public function destroy(product $product)
    {
        if ($product->imagepath) {
                Storage::disk('public')->delete($product->imagepath);
            }
        $product->delete();
        return redirect('product')->with('success','product Deleted Successfully!');
    }


    
}
