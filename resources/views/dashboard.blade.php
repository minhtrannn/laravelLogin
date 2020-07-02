@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <a href="/posts/create" class="btn btn-primary">Create Post</a>
                    <h3>Your Blog Posts</h3>
                    @if (count($posts) > 0)
                    <table class="table table-striped">
                        <tr>
                            <th>Title</th>
                            <th></th>
                            <th></th>
                        </tr>
                       @foreach ($posts as $post)
                        <tr>
                            <th>{{$post->title}}</th>
                            <th><a href = "/posts/{{$post->id}}/edit" class = "btn btn-primary">Edit</a></th>
                            <th>    
                                {!! Form::open (['method' => 'DELETE', 'action' => ['PostsController@destroy',$post->id]])!!}
                                    {{Form::submit('Delete',['class' => 'btn btn-danger float-right'])}}
                                {!! Form::close() !!}
                            </th>
                        </tr>
                       @endforeach
                    </table>
                    @else 
                        <p>You have no posts</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
