@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <p><strong>Product List</strong></p>

                    @if(count($products) > 0)
                        <table class="table table-striped">
                            <tr>
                                <th>Title</th>
                                <th></th>
                                <th></th>
                            </tr>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{$product->title}}</td>
                                    <td><a href="/products/{{$product->id}}/edit" class="btn btn-secondary">Edit</a></td>
                                    <td>
                                            {!!Form::open(['action' => ['ProductsController@destroy', $product->id], 'method' => 'POST', 'class' => 'float-right'])!!}
                                                {{Form::hidden('_method')}}
                                                {{Form::submit('Delete', ['class' => 'btn btn-outline-danger'])}}
                                            {!!Form::close()!!}
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <p>You haven't added any items.</p>
                    @endif
                    <hr>
                    <a href="/products/create" class="btn btn-danger">Add another product</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
