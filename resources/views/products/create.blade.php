@extends('layouts.app')

@section('content')
	<div class="container">
		<h1>Create Post</h1>
		{!! Form::open(['action' => 'ProductsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
		 	<div class="form-group">
		 		{{Form::label('title', 'Title')}}
		 		{{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}
		 	</div>
		 	<div class="form-group">
		 		{{Form::label('body', 'Body')}}
		 		{{Form::textarea('body', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Description'])}}
		 	</div>
		 	<div class="form-group">
		 		{{Form::file('product_img')}}
		 	</div>
		 	{{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
		{!! Form::close() !!}
	</div>

@endsection