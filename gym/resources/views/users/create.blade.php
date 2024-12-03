@extends('layout')

@section('title', 'Add a new user!')

@section('content')
    <h1>Add a new user</h1>
    <div class="container">
        <div class="row g-2">
            <form method="POST" action="/users">
                @csrf

                <div class='form-group mt-2'>
                    <div class='flex-column'>
                        <x-form-label for='name'>Name</x-form-label>
                        <x-form-input name='name' placeholder='name' required/>
                        <x-form-error name='name'></x-form-error>
                    </div>

                    <div class='form-group mt-2'>
                        <x-form-label for='email'>Email</x-form-label>
                        <x-form-input name='email' placeholder='email' required/>
                        <x-form-error name='email'></x-form-error>
                    </div>

                    <div class='form-group mt-2'>
                        <x-form-label for='password'>Password</x-form-label>
                        <x-form-input name='password' placeholder='password' type="password" required/>
                        <x-form-error name='password'></x-form-error>
                    </div>



                    <div class='form-group mt-2'>
                        <x-form-label for='role'>Role</x-form-label>
                        <select class='form-select' name='role'>

                            <option value='user'>user</option>
                            <option value='trainer'>trainer</option>
                            <option value='admin'>admin</option>

                        </select>
                        <x-form-error name='role'></x-form-error>
                    </div>


                </div>
                <div class="mt-3">
                    <a href="{{ route('users.index') }}" type="button" class="btn btn-outline-dark">Cancel</a>
                    <button type="submit" class="btn btn-primary ms-2">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection
