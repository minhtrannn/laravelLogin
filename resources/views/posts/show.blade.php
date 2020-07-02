@extends('layouts.app')

@section('content')
    <a class="btn btn-outline-secondary" href="/posts">Go Back</a>
    <h3>{{$post->title}}</h3>
    <p>{{$post->created_at}}</p>
    <div>{{$post->body}}</div>
    <hr>
    @if (!Auth::guest())
        @if (Auth::user()->id == $post->user_id)
        <a href="/posts/{{$post->id}}/edit" class = "btn btn-primary float-left">Edit</a>
        {!! Form::open (['method' => 'DELETE', 'action' => ['PostsController@destroy',$post->id]])!!}
            {{Form::submit('Delete',['class' => 'btn btn-danger float-right'])}}
        {!! Form::close() !!}
        @endif
    @endif
    {{-- <a href="/posts/{{$post->id}}" class="btn btn-danger float-right">Delete</a> --}}

@endsection