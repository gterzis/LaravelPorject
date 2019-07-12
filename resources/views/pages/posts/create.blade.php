@extends('layout')
@section('title')<title>Create Post</title> @endsection

@section('content')
    {{-- Dropzone --}}
    <script src="/WebDeveloperTest/resources/views/includes/dropzone.js"></script>
    <link rel="stylesheet" href="/WebDeveloperTest/resources/views/includes/dist/dropzone.css">

    <h1>Create Post</h1>
    {!! Form::open(['action' => 'PostsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="form-group">
        {{Form::label('title', 'Title')}}
        {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}
        <br>
        {{Form::label('subtitle', 'Subtitle')}}
        {{Form::text('subtitle', '', ['class' => 'form-control', 'placeholder' => 'Subtitle'])}}
        <br>
        {{Form::label('slug', 'Slug')}}
        {{Form::text('slug', '', ['class' => 'form-control', 'placeholder' => 'Slug'])}}
        <br>
        {{Form::label('categories', 'Select categories (Hold ctrl to select multiple)')}}
        {{Form::select('categories[]',  $categories, null, ['class' => 'form-control', 'multiple']) }}

    </div>
    <div class="form-group">
        {{Form::label('content', 'Content')}}
        {{Form::textarea('content', '', ['class' => 'form-control', 'placeholder' => 'Content'])}}
    </div>
    <div class="form-group">
        <div class="dropzone" id="my-awesome-dropzone">
            <div class="fallback">
                <input name="cover_image" type="file" multiple />
            </div>
        </div>
    </div>
    {{Form::submit('Create', ['class'=>'btn btn-primary'])}}
    <br><br>
    {!! Form::close() !!}
@endsection
