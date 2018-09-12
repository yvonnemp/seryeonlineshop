@extends('layouts.app')

@section('content')
	<div class="container">
		<h1>Edit Post</h1>
		{!! Form::open(['action' => ['ProductsController@update', $product->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
		 	<div class="form-group">
		 		{{Form::label('title', 'Title')}}
		 		{{Form::text('title', $product->title, ['class' => 'form-control', 'placeholder' => 'Title'])}}
		 	</div>
		 	<div class="form-group">
		 		{{Form::label('body', 'Body')}}
		 		{{Form::textarea('body', $product->body, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Description'])}}
		 	</div>
		 	<div class="form-group">
		 		{{Form::file('product_img')}}
		 	</div>
		 	{{Form::hidden('_method', 'PUT')}}
		 	{{Form::submit('Submit',['class'=>'btn btn-primary'])}}
		{!! Form::close() !!}
	</div>

@endsection