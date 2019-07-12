@extends('layout')
@section('title')<title>{{$data['post']->title}}</title> @endsection

@section('content')
    {{-- Sweet Alert message --}}
    <script src="/WebDeveloperTest/resources/views/includes/deleteMessage.js"></script>

    <div class="well">
        <div>
            <a href="{{ action('PostsController@index') }}" class="btn btn-primary">Back</a>
            <br><br>
            <h1>{{$data['post']->title}}</h1>
            <img style="width:20%" src="/WebDeveloperTest/storage/app/public/cover_images/{{$data['post']->cover_image}}">
            <p>Subtitle: {{$data['post']->subtitle}}</p>
            <p>Slug: {{$data['post']->slug}}</p>
            <p>{{$data['post']->content}}</p>
            <span>Categories: </span>
            @foreach($data['categories'] as $category)
                <span class="badge badge-pill badge-secondary">{{$category->title}}</span>
            @endforeach
            <br><br>
            <small> <strong>created at:</strong> {{$data['post']->created_at}}</small>
            <small><strong>updated at:</strong>  {{$data['post']->updated_at}}</small>
            <br> <br>
            <a href="{{ action('PostsController@index') }}/{{$data['post']->id}}/edit" class="btn btn-default" style="border: 1px steelblue solid; ">Edit</a>
            {!!Form::open(['id'=>'deleteForm', 'action' => ['PostsController@destroy', $data['post']->id], 'method' => 'POST', 'hidden'])!!}
            {{Form::hidden('_method', 'DELETE')}}
            {!!Form::close()!!}
            <a id="delete" onclick="deleteData();" data-token="{{ csrf_token() }}" class="btn btn-default" style="border: 1px #d0211c solid; color: #d0211c;">Delete</a>
            <br><br>
        </div>
    </div>

@endsection
