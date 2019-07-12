@extends('layout')
@section('title')<title>Create Category</title> @endsection
@section('content')
    <h1>Create Category</h1>
    {!! Form::open(['action' => 'CategoriesController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="form-group">
        {{Form::label('title', 'Title')}}
        {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}
        <br>
        {{Form::label('slug', 'Slug')}}
        {{Form::text('slug', '', ['class' => 'form-control', 'placeholder' => 'Slug'])}}
    </div>
    {{Form::submit('Create', ['class'=>'btn btn-primary'])}}
    <br><br>
    {!! Form::close() !!}
@endsection
