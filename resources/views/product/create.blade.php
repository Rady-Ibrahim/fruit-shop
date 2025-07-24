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
						<h2>Add product</h2>
					</div>
				 	<div id="form_status"></div>
					<div class="contact-form">
                        <form action="{{ url('product') }}" method="post" enctype="multipart/form-data">
                            @csrf
							
							<p>
								<input type="text" name="name" required placeholder="product name">
								<span class="text-danger">
								@error('name')
									{{ $message }}	
								@enderror
							</span>
							</p>

							<p>
							<select name="category_id" required class="form-control">
								<option value="">اختر القسم</option>
								@foreach($categories as $category)
									<option value="{{ $category->id }}">{{ $category->name }}</option>
								@endforeach
							</select>
							<span class="text-danger">
								@error('category_id')
									{{ $message }}
								@enderror
							</span>
							</p>
							<p><textarea name="description" id="description" cols="30" rows="10" placeholder="description"></textarea>
															<span class="text-danger">
								@error('description')
									{{ $message }}	
								@enderror
							</span>
							</p>

							<p>
								<input type="text" name="quantity" placeholder="quantity" >
								<span class="text-danger">
								@error('quantity')
									{{ $message }}	
								@enderror
							</span>
							</p>

							<p>
								<input type="text" name="price" required placeholder="price">
								<span class="text-danger">
								@error('price')
									{{ $message }}	
								@enderror
							</span>
							</p>
							
                            <input type ="file" name=imagepath  id="imagepath" class="form-control" required>
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