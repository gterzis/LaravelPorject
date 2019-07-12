<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    @yield('title')
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-primary">

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto" style="margin-left: 105px;">

            <li class="nav-item">
                <a class="nav-link" href="{{ action('PostsController@index') }}"><strong>Posts</strong></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ action('CategoriesController@index') }}"><strong>Categories</strong></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ action('PostsController@index') }}/create"><strong>Create post</strong></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ action('CategoriesController@index') }}/create"><strong>Create category</strong></a>
            </li>

        </ul>
    </div>

</nav>

<div class="container">
    @include('includes.messages')
    @yield('content')
</div>

</body>
</html>
