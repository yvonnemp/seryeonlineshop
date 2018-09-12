@extends('layouts.app')

@section('content')
	<div class="container">
		<h1>Products</h1>
		@if(count($products) > 0)
			@foreach($products as $product)
				<div class="card">
					<div class="row">
						<div class="col-md-4 col-sm-4">
							<img style="width:100%;" src="/storage/product_img/{{$product->product_img}}" alt="">
						</div>
						<div class="col-md-8 col-sm-8">
							<h3><a href="{{route('products.show', $product->id)}}">{{$product->title}}</a></h3>
							<small>Posted on {{$product->created_at}} by {{$product->user['name']}}</small>
						</div>
					</div>
				</div>
			@endforeach
			{{$products->links()}}
		@else
			<p>No products found.</p>
		@endif
	</div>
@endsection
