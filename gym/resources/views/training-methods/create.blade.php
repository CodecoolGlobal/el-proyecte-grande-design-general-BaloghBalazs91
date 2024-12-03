@extends('layout')

@section('title', 'Create a training method')

@section('content')
    <h1>Create a training method</h1>
    <div class="container">
        <div class="row g-2">
            <form method="POST" action="/training-methods" enctype="multipart/form-data">
                @csrf

                <div class='form-group mt-2'>
                    <div class='flex-column'>
                        <x-form-label for='name'>Name</x-form-label>
                        <x-form-input name='name' id='name' placeholder='aerobik' required/>
                        <x-form-error name='name'></x-form-error>
                    </div>

                    <div class='form-group mt-2'>
                        <x-form-label for='description'>Description</x-form-label>
                        <textarea
                            name="description"
                            id="description"
                            class="form-control"
                            rows="5"
                            placeholder="Enter a detailed description"
                            required>
Az aerobik, mint zenére végzett mozgásos tevékenység, alapjait tekintve megegyező, de
céljaiban eltérő két különböző ágra osztható fel. </textarea>
                        <x-form-error name='description'></x-form-error>
                    </div>

                    <div class='form-group mt-2'>
                        <x-form-label for='image'>Image</x-form-label>
                        <input type="file" name="image" id="image" class="form-control" required>
                        <x-form-error name='image'></x-form-error>
                    </div>

                    <div class='form-group mt-2'>
                        <x-form-label for='trainers'>Trainers</x-form-label>
                        <select class='form-select' name='trainers[]' id='trainers' multiple>
                            @foreach ($trainers as $trainer)
                                <option value='{{ $trainer->id }}'>{{ $trainer->name }}</option>
                            @endforeach
                        </select>
                        <x-form-error name='trainers'></x-form-error>
                    </div>

                </div>
                <div class="mt-3">
                    <a href="/training-methods" type="button" class="btn btn-outline-dark">Cancel</a>
                    <button type="submit" class="btn btn-primary ms-2">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection
