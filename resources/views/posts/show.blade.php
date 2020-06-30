@extends('layouts.app')

@section('content')
    <a class="btn btn-outline-secondary" href="/posts">Go Back</a>
    <h3>{{$post->title}}</h3>
    <p>{{$post->created_at}}</p>
    <div>{{$post->body}}</div>
    <hr>

    <a href="/posts/{{$post->id}}/edit" class = "btn btn-primary float-left">Edit</a>
    {!! Form::open (['method' => 'DELETE', 'action' => ['PostsController@destroy',$post->id]])!!}
        {{Form::submit('Delete',['class' => 'btn btn-danger float-right'])}}
    {!! Form::close() !!}
    {{-- <a href="/posts/{{$post->id}}" class="btn btn-danger float-right">Delete</a> --}}

@endsection