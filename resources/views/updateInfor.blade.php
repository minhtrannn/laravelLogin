@extends('layouts.app')

@section('content')
<div class="jumbotron text-center">
    <h1>Update information</h1>
    <div class="form-group row d-flex justify-content-center">
        <img style="width:6%" src="/storage/cover_images/{{$user->cover_image}}" alt="">
    </div>
        <form action="/infor/{{$user->id}}" method="Post" enctype='multipart/form-data'>
        @csrf
        {{-- <input name="id" type="hidden" value="{{$user->id}}"> --}}
    
        <div class="form-group row d-flex justify-content-center">
            <input id = 'cover_image' name = 'cover_image' type = "file" accept="image/png, image/jpeg">
        </div>

        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">Email Address</label>
            <div class="col-md-2">{{$user->email}}</div>
            <div class="col-md-4">
                <input type="email" id = "email" name = "email" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
            <div class="col-md-2">{{$user->name}}</div>
            <div class="col-md-4">
                <input type="text" id = "name" name = "name" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
            <div class="col-md-2">********</div>
            <div class="col-md-4">
                <input type = "password" id = "password" name = "password" required> 
            </div>
        </div>
        <button type="submit" class="btn btn-info">Submit</button>
    </form>
    
</div>
@endsection