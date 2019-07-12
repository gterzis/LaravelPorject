@extends('layout')
@section('title')<title>Edit Post</title> @endsection

@section('content')
    <h1>Edit Post</h1>
    {!! Form::open(['action' => ['PostsController@update', $data['post']->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="form-group">
        {{Form::label('title', 'Title')}}
        {{Form::text('title', $data['post']->title, ['class' => 'form-control', 'placeholder' => 'Title'])}}
        <br>
        {{Form::label('subtitle', 'Subtitle')}}
        {{Form::text('subtitle', $data['post']->subtitle, ['class' => 'form-control', 'placeholder' => 'Subtitle'])}}
        <br>
        {{Form::label('slug', 'Slug')}}
        {{Form::text('slug', $data['post']->slug, ['class' => 'form-control', 'placeholder' => 'Slug'])}}
    </div>
    <div class="form-group">
        {{Form::label('content', 'Content')}}
        {{Form::textarea('content', $data['post']->content, ['class' => 'form-control', 'placeholder' => 'Content'])}}

        <br>
        {{Form::label('categories', 'Select categories (Hold ctrl to select multiple)')}}
        {{Form::select('categories[]',  $data['categories'], null, ['class' => 'form-control', 'multiple']) }}
    </div>
    <div class="form-group">
        {{Form::file('cover_image')}}
    </div>
    {{Form::hidden('_method', 'PUT')}} {{-- spoofing POST method   --}}
    {{Form::submit('Edit', ['class'=>'btn btn-primary'])}}
    <br><br>
    {!! Form::close() !!}
@endsection
