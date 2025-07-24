@extends('layouts.master')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Document</title>
</head>
<body>
    {{-- @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif --}}


<div class="contact-from-section mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 mb-5 mb-lg-0">
					<div class="form-title">
						<h2>edit product</h2>
					</div>
				 	<div id="form_status"></div>
					<div class="contact-form">
                        <form action="{{ route('product.update',$product) }}" method="post" enctype="multipart/form-data">
                            @csrf
							@method('PUT')
							<p>
								<input type="text" name="name" value="{{ $product->name }}" required placeholder="product name">
								<span class="text-danger">
								@error('name')
									{{ $message }}	
								@enderror
							</span>
							</p>

							<p>
							<select name="category_id" id="category_id" required class="form-control">
								<option value="">Select Category</option>
								{{-- Assuming $categories is passed to the view --}}
								@foreach($categories as $category)
									<option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
								@endforeach
							</select>
							<span class="text-danger">
								@error('category_id')
									{{ $message }}
								@enderror
							</span>
							</p>
							<p><textarea name="description" id="description" cols="30" rows="10" placeholder="description">{{ $product->description }}</textarea>
															<span class="text-danger">
								@error('description')
									{{ $message }}	
								@enderror
							</span>
							</p>

							<p>
								<input type="text" name="quantity" value="{{ $product->quantity }}" placeholder="quantity" >
								<span class="text-danger">
								@error('quantity')
									{{ $message }}	
								@enderror
							</span>
							</p>

							<p>
								<input type="text" name="price" value="{{ $product->price }}" required placeholder="price">
								<span class="text-danger">
								@error('price')
									{{ $message }}	
								@enderror
							</span>
							</p>

							<p>
								<img src="{{ asset('storage/'.$product->imagepath) }}" alt="Product Image" style="width: 100px; height: 100px;">
								<span class="text-danger">
							</p>

                            <input type ="file" name=imagepath  id="imagepath" value="{{ $product->imagepath }}" class="form-control" required>

							<p><input type="submit" value="Submit"></p>
						</form>
					</div>
				</div>

			</div>
		</div>
	</div>

</body>
</html>

@endsection