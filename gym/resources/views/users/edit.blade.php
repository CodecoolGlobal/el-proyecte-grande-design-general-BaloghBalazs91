@extends('layout')

@section('title', 'Edit User')

@section('content')
    <h1>Edit User</h1>
    <div class='container'>
        <div class='row g-2'>
            <form method='POST' action='/users/{{ $user->id }}'>
                @csrf
                @method('PUT')

                <div class='form-group mt-2'>
                    <div class='flex-column'>
                        <x-form-label for='name'>Name</x-form-label>
                        <x-form-input name='name' id='name' value='{{ $user->name }}' required />
                        <x-form-error name='name'></x-form-error>
                    </div>

                    <div class='form-group mt-2'>
                        <x-form-label for='email'>Email</x-form-label>
                        <x-form-input name='email' id='email' value='{{ $user->email }}' required />
                        <x-form-error name='email'></x-form-error>
                    </div>

                    <div class='form-group mt-2' type="password">
                        <x-form-label for='old_password'>Old Password</x-form-label>
                        <x-form-input name='old_password' id='old_password' />
                        <x-form-error name='old_password'></x-form-error>
                    </div>

                    <div class='form-group mt-2'>
                        <x-form-label for='new_password1'>New Password</x-form-label>
                        <x-form-input name='new_password1' id='new_password1' />
                        <x-form-error name='new_password1'></x-form-error>
                    </div>

                    <div class='form-group mt-2'>
                        <x-form-label for='new_password2'>New Password</x-form-label>
                        <x-form-input name='new_password2' id='new_password2' />
                        <x-form-error name='new_password2'></x-form-error>
                    </div>

                    <div class='form-group mt-2' {{$user->role==='admin'?'':'hidden'}}>
                        <x-form-label for='role'>Role</x-form-label>
                        <select class='form-select' name='role'>
                            <option value='{{ $user->role }}'>{{ ucfirst($user->role) }}</option>
                            @if($user->role !== 'user')
                                <option value='user'>User</option>
                            @endif
                            @if($user->role !== 'trainer')
                                <option value='trainer'>Trainer</option>
                            @endif
                            @if($user->role !== 'admin')
                                <option value='admin'>Admin</option>
                            @endif
                        </select>
                        <x-form-error name='role'></x-form-error>
                    </div>


                    <div class='container mt-3 ps-0'>
                        <div class='row'>
                            <div class='col d-flex justify-content-between'>
                                <button form='delete-form' class='btn btn-danger'>Delete</button>
                                <div>
                                    <a href='/users/{{ $user->id }}' type='button' class='btn btn-outline-dark'>Cancel</a>
                                    <button type='submit' class='btn btn-primary ms-2'>Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <form method='POST' action='/users/{{ $user->id }}' id='delete-form' style='display:none;'>
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>
@endsection
