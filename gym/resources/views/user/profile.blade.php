@extends('layout')
@section('title','Profile')
@section('content')
    <div class="container">
        <h2>Profile</h2>
            <div class="card">
            <div class="card-body">
                <h5 class="card-title">User Data</h5>
                <p class="card-text">Name : {{$user->name}}</p>
                <p class="card-text">Email : {{$user->email}}</p>
            </div>
            </div>
    </div>
@endsection
