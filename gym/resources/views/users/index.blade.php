@extends('layout')

@section('title', 'Users list')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col d-flex justify-content-between align-content-start">
                <h1>Users</h1>
                <a href="{{ route('users.create') }}" class="btn btn-primary">New User</a>
            </div>
        </div>
    </div>
    <div class="container mt-3">
        <div class="row">
            <div class="col">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Created_at</th>
                        <th scope="col"> </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <th scope="row">{{ $user->id }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                            <td>{{ $user->created_at ?$user->created_at->format('Y-m-d H:i:s') : null }}</td>
                            <td>
                                <a href="{{ route('users.edit', ['user' => $user]) }}" class="btn btn-primary">Update</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
