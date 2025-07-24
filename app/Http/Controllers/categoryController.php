<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch categories from the database
        $categories = Category::all();
        $products = Product::paginate(5);

        // Return the view with categories
        return view('category.index', compact('categories', 'products'));


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|min:3|max:20',
            'description' => 'required|string|min:3|max:1000',
            'imagepath' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $data['imagepath'] = $request->file('imagepath')->store('photos','public');


        
        Category::create($data);
        return redirect('category')->with('success','category Created Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('category');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $item)
    {
        return view('category.edit',compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $item)
    {
        $data = $request->validate([
            'name' => 'required|min:3|max:20',
            'description' => 'required|min:3|max:1000',
            'imagepath' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        dd ($data);

        if ($request->hasFile('imagepath')) {
            if ($item->imagepath) {
                Storage::disk('public')->delete($item->imagepath);
            }
            $data['imagepath'] = $request->file('imagepath')->store('photo','public');
        }   
        //$data['banner_image'] = $request->file('banner_image')->store('blog','public');
        $item->update($data);
        
        return redirect('category')->with('success','Blog Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
