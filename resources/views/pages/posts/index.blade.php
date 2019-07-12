@extends('layout')
@section('title')<title>Posts</title> @endsection


@section('content')
{{-- Sweet Alert message --}}
<script src="/WebDeveloperTest/resources/views/includes/deleteMessage.js"></script>

<h1>Posts</h1>
    @if(count($posts)>0)
        @foreach($posts as $post)
            <div class="well">
                <div>
                    <hr>
                    <h3><a href="posts/{{$post->id}}">{{$post->title}} </a> </h3>
                    <small> <strong>created at:</strong> {{$post->created_at}}</small>
                    <small><strong>updated at:</strong>  {{$post->updated_at}}</small>
                </div>
            </div>
        @endforeach
        {{-- Pagination links --}}
        <br>
        <div id="pagination">
        {{$posts->links()}}
        </div>

    @else
        <h4>No posts found</h4>
    @endif

@endsection
