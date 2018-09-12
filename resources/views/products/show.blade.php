@extends('layouts.app')

@section('content')
	<div class="container">
		<a href="/products" class="btn btn-outline-danger float-right">Go Back</a>
		<div class="clear">&nbsp;</div>
		<h1>{{$product->title}}</h1>
		<img src="/storage/product_img/{{$product->product_img}}" alt="">
		<br><br>
		<div>
			{!!$product->body!!}
		</div>
	<small>Posted on {{$product->created_at}} by {{$product->user['name']}}</small>
	<hr>
	@if(!Auth::guest())
		@if(Auth::user()->id == $product->user_id)
			<a href="/products/{{$product->id}}/edit" class="btn btn-outline-danger">Edit</a>

			{!!Form::open(['action' => ['ProductsController@destroy', $product->id], 'method' => 'POST', 'class' => 'float-right'])!!}
				{{Form::hidden('_method', 'Delete')}}
				{{Form::submit('Delete', ['class' => 'btn btn-outline-danger'])}}
			{!!Form::close()!!}
		@endif
	@endif
	</div>

@endsection
