@extends('layouts.app')

@section('content')
    <h1>Posts</h1>
    @foreach ($posts as $post)
        <div class="well">
            <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
            <p>{{$post->created_at}}</p>
        </div>
    @endforeach
@endsection