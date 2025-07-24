
@extends('layouts.master')


 

@section('content')
<div class="product-section mt-150 mb-150">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="section-title">	
                    <h3><span class="orange-text">All</span> Products</h3>
                </div>
            </div>
        </div>


        {{-- <div class="row">
                <div class="col-md-12">
                    <div class="product-filters">
                        <ul>
                            <li class="active" data-filter="*">All</li>
                            @foreach ($categories as $item)
                                <li data-filter="._{{ $item->id }}">{{ $item->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div> --}}


            <div class="row product-lists">
            @foreach ($products as $item)
            <div class="col-lg-4 col-md-6 text-center _{{ $item->category_id }}">
                <div class="single-product-item">
                    <div class="single-product-item">
						<div class="product-image">
                            <a href="{{ route('product.show', $item->id) }}">
                            <img style="max-height: 250px !important ;min-height: 205px !important" src="storage/{{ $item->imagepath }}" alt=""></a>
                        </div>
                    <h3>{{ $item->name }}</h3>
                    <p class="product-price"><span>{{ $item->quantity }}</span>{{ $item->price }}$ </p>
                    <a href="{{ route('product.edit',$item) }}" class="cart-btn"><i class=""></i> ✏️ Edit</a>
                    
                    <form action="{{ route('product.destroy',$item) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this product?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="cart-btn" style="background-color: rgb(255, 149, 0); color: white; border: none; padding: 10px 20px; cursor: pointer;">
                            🗑 Delete
                        </button>
                    </form>


                                
                    <form action="{{ route('addtocart') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $item->id }}">
                        <button type="submit">Add to Cart</button>
                    </form>
                    </div>
                </div>
            </div>
            @endforeach
            <div style="text-align: center; width: 100%; margin-top: 20px;"> 
                {{ $products->links() }}
             </div>
        </div>

    </div>
</div>

@endsection

<style>
    svg{
        height: 50px;
    }
</style>