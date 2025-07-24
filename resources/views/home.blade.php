
@extends('layouts.master')




@section('content')
<div class="product-section mt-150 mb-150">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="section-title">	
                    <h3><span class="orange-text">الا</span>قسام</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, fuga quas itaque eveniet beatae optio.</p>
                </div>
            </div>
        </div>


        <div class="row">
                <div class="col-md-12">
                    <div class="product-filters">
                        <ul>
                            <li class="active" data-filter="*">All</li>
                            @foreach ($categories as $item)
                                <li class="active" data-filter="._{{ $item->id }}">
                                    <img src="{{ asset('storage/'.$item->imagepath) }}" alt="" style="width: 30px; height: 30px; border-radius: 50%;">
                                    {{ $item->name }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>


            <div class="row product-lists">
            @foreach ($products as $item)
            <div class="col-lg-4 col-md-6 text-center _{{ $item->category_id }}">
                <div class="single-product-item">
                    <div class="single-product-item">
						<div class="product-image">
                            <img style="max-height: 250px !important ;min-height: 205px !important" src="storage/{{ $item->imagepath }}" alt=""></a>
                        </div>
                    <h3>{{ $item->name }}</h3>
                    <p class="product-price"><span>{{ $item->quantity }}</span>{{ $item->price }}$ </p>
                    <a href="{{ route('category.edit',$item) }}" class="cart-btn"><i class=""></i> ✏️ Edit</a>

                    
                    <a href="cart.html" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
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