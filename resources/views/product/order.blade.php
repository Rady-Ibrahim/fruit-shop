@extends('layouts.master')
@section('content')
    <!-- breadcrumb-section -->
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        <p>Fresh and Organic</p>
                        <h1>Check Out Product</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->

    <!-- check out section -->
    <div class="checkout-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="checkout-accordion-wrap">
                        <div class="accordion" id="accordionExample">
                            <div class="card single-accordion">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" type="button" data-toggle="collapse"
                                            data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Billing Address
                                        </button>
                                    </h5>
                                </div>

                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                    data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="billing-address-form">
                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                            <form action="/storeorder" method="POST" id="store-order" name="store-order">
                                                @csrf
                                                <p><input type="text" name="name" placeholder="Name"></p>
                                                <p><input type="email" name="email" placeholder="Email"></p>
                                                <p><input type="text" name="address" placeholder="Address"></p>
                                                <p><input type="text" name="phone" placeholder="Phone"></p>
                                                <p>
                                                    <textarea name="note" id="note" cols="30" rows="10" placeholder="Say Something"></textarea>
                                                </p>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card single-accordion">
                                <div class="card-header" id="headingTwo">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                            data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Shipping Address
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                    data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shipping-address-form">
                                            <p>Your shipping address form is here.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card single-accordion">
                                <div class="card-header" id="headingThree">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                            data-target="#collapseThree" aria-expanded="false"
                                            aria-controls="collapseThree">
                                            Card Details
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                    data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="card-details">
                                            <div class="col-lg-8 col-md-12">
                                                <div class="cart-table-wrap">
                                                    <table class="cart-table">
                                                        <thead class="cart-table-head">
                                                            <tr class="table-head-row">
                                                                <th class="product-remove"></th>
                                                                <th class="product-image">Product Image</th>
                                                                <th class="product-name">Name</th>
                                                                <th class="product-price">Price</th>
                                                                <th class="product-quantity">Quantity</th>
                                                                <th class="product-total">Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($cartItems as $item)
                                                                <tr class="table-body-row">
                                                                    <td class="product-remove"><a
                                                                            href="{{ route('cart.remove', $item->product_id) }}"><i
                                                                                class="far fa-window-close"></i></a></td>
                                                                    <td class="product-image"><img
                                                                            src="storage/{{ $item->product->imagepath }}"
                                                                            alt=""></td>
                                                                    <td class="product-name">{{ $item->product->name }}
                                                                    </td>
                                                                    <td class="product-price">${{ $item->product->price }}
                                                                    </td>
                                                                    <td>
                                                                        <form action="{{ route('cart.update') }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            <input type="hidden" name="product_id"
                                                                                value="{{ $item->product_id }}">
                                                                            <input type="number" name="quantity"
                                                                                value="{{ $item->quantity }}"
                                                                                min="1">
                                                                            <button type="submit">Update</button>
                                                                        </form>
                                                                    </td>
                                                                    <td class="product-total">
                                                                        ${{ $item->product->price * $item->quantity }}</td>
                                                                </tr>
                                                            @endforeach

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="total-section">
                                                    <table class="total-table">
                                                        <thead class="total-table-head">
                                                            <tr class="table-total-row">
                                                                <th>Total</th>
                                                                <th>Price</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <tr class="total-data">
                                                                <td><strong>Total: </strong></td>
                                                                <td>${{ $total }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-4">
                    
                    <div class="order-details-wrap">
                        <table class="order-details">
                            <thead>
                                <tr>
                                    <th>Your order Details</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody class="order-details-body">
                                <tr>
                                    <td>Product</td>
                                    <td>Total</td>
                                </tr>
                                @foreach ($cartItems as $item)
                                <tr>
                                    <td>{{ $item->product->name }}</td>
                                    <td>${{ $item->product->price * $item->quantity }}</td>
                                </tr>
                                <tr>
                                @endforeach
                            </tbody>
                            
                            <tbody class="checkout-details">
                                <tr>
                                    <td>Total</td>
                                    <td>${{ $total }}</td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                    
                </div>
            </div>
            <div class="col-lg-12 mt-5">
                <a onclick="event.preventDefault(); document.getElementById('store-order').submit();"
                    class="boxed-btn">Place Order</a>
            </div>
        </div>
    </div>

    <!-- end check out section -->

    <!-- logo carousel -->
    <div class="logo-carousel-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="logo-carousel-inner">
                        <div class="single-logo-item">
                            <img src="assets/img/company-logos/1.png" alt="">
                        </div>
                        <div class="single-logo-item">
                            <img src="assets/img/company-logos/2.png" alt="">
                        </div>
                        <div class="single-logo-item">
                            <img src="assets/img/company-logos/3.png" alt="">
                        </div>
                        <div class="single-logo-item">
                            <img src="assets/img/company-logos/4.png" alt="">
                        </div>
                        <div class="single-logo-item">
                            <img src="assets/img/company-logos/5.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
