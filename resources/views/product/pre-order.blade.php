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

                            @foreach ($orders as $order)
                                <div class="card single-accordion">
                                    <div class="card-header" id="headingOne">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link" type="button" data-toggle="collapse"
                                                data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                Order Number {{ $order->id }} - {{ $order->created_at->format('d-m-Y') }}
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
                                                <form>
                                                    @csrf
                                                    <p><input type="text" name="name" value="{{ $order->name }}"
                                                            placeholder="Name"></p>
                                                    <p><input type="email" name="email" value="{{ $order->email }}"
                                                            placeholder="Email"></p>
                                                    <p><input type="text" name="address" value="{{ $order->address }}"
                                                            placeholder="Address"></p>
                                                    <p><input type="text" name="phone" value="{{ $order->phone }}"
                                                            placeholder="Phone"></p>
                                                    <p>
                                                        <textarea name="note" value="{{ $order->note }}" id="note" cols="30" rows="10"
                                                            placeholder="Say Something"></textarea>
                                                    </p>
                                                </form>
                                                <div class="cart-table-wrap-total" style="display: flex; gap: 30px; align-items: flex-start;">
                                                    <div class="cart-table-wrap" style="flex: 2;">
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
                                                                @foreach ($order->orderDetails as $item)
                                                                    <tr class="table-body-row">
                                                                        <td class="product-remove"><a
                                                                                href="{{ route('cart.remove', $item->product_id) }}"><i
                                                                                    class="far fa-window-close"></i></a>
                                                                        </td>
                                                                        <td class="product-image"><img
                                                                                src="storage/{{ $item->product->imagepath }}"
                                                                                alt=""></td>
                                                                        <td class="product-name">{{ $item->product->name }}
                                                                        </td>
                                                                        <td class="product-price">
                                                                            ${{ $item->product->price }}
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
                                                                            ${{ $item->product->price * $item->quantity }}
                                                                        </td>
                                                                        <div class="col-lg-4">

                                                                        </div>
                                                                    </tr>
                                                                @endforeach

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="total-section" style="flex: 1;">
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
                                                                    <td>${{ $order->orderDetails->sum(function ($detail) {
                                                                        return $detail->product->price * $detail->quantity;
                                                                    }) }}
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach


                        </div>

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
@endsection
