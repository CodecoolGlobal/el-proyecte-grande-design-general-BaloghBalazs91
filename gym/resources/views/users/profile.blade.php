@extends('layout')
@section('title','Profile')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col d-flex justify-content-between align-content-start">
                <h1>Profile</h1>
                <a href="/users/{{$user->id}}/edit" class="btn btn-primary">Edit</a>
            </div>
        </div>

            <div class="card">
                <div class="card-body">
                   <h5 class="card-title">User Data</h5>
                   <p class="card-text">Name : {{$user->name}}</p>
                   <p class="card-text">Email : {{$user->email}}</p>
                </div>

            </div>
    </div>
@endsection
