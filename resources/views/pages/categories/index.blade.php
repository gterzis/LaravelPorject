@extends('layout')
@section('title')<title>Categories</title> @endsection
@section('content')
    {{-- Sweet Alert message --}}
    <script src="/WebDeveloperTest/resources/views/includes/deleteMessage.js"></script>

    <h1>Categories</h1>
    @if(count($categories)>0)
        @foreach($categories as $category)
            <div class="well">
                <div>
                    <hr>
                    <h3>{{$category->title}}</h3>
                    <p>Slug: {{$category->slug}}</p>
                    <small> <strong>created at:</strong> {{$category->created_at}}</small>
                    <small><strong>updated at:</strong>  {{$category->updated_at}}</small>
                    <br> <br>
                    <a href="categories/{{$category->id}}/edit" class="btn btn-default" style="border: 1px steelblue solid; ">Edit</a>
                    {!!Form::open(['id'=>'deleteForm', 'action' => ['CategoriesController@destroy', $category->id], 'method' => 'POST', 'hidden'])!!}
                    {{Form::hidden('_method', 'DELETE')}}
                    {!!Form::close()!!}
                    <a id="delete" onclick="deleteData();" data-token="{{ csrf_token() }}" class="btn btn-default" style="border: 1px #d0211c solid; color: #d0211c;">Delete</a>
                    <br><br>
                </div>
            </div>
        @endforeach
        {{-- Pagination links --}}
        <div id="pagination">
            {{$categories->links()}}
        </div>

    @else
        <h4>No categories found</h4>
    @endif
@endsection
