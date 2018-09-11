<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{asset('css/app.css')}}">

    {{-- Custom CSS --}}
	<link rel="stylesheet" href="{{asset('sass/app.scss')}}">

    <title>{{config('app.name', 'SERYE')}}</title>
</head>

    <body>
    	@include('include.navbar')
    		@yield('content')
    </body>

</html>
