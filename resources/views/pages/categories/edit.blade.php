@extends('layout')
@section('title')<title>Edit Category</title> @endsection

@section('content')
    <h1>Edit Category</h1>
    {!! Form::open(['action' => ['CategoriesController@update', $category->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="form-group">
        {{Form::label('title', 'Title')}}
        {{Form::text('title', $category->title, ['class' => 'form-control', 'placeholder' => 'Title'])}}
        <br>

        {{Form::label('slug', 'Slug')}}
        {{Form::text('slug', $category->slug, ['class' => 'form-control', 'placeholder' => 'Slug'])}}
    </div>
    {{Form::hidden('_method', 'PUT')}} {{-- spoofing POST method   --}}
    {{Form::submit('Edit', ['class'=>'btn btn-primary'])}}
    <br><br>
    {!! Form::close() !!}
@endsection
