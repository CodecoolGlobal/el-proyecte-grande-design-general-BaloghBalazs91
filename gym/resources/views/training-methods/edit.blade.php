@extends('layout')

@section('title', 'Update a training method')

@section('content')
    <h1>Update a training method</h1>
    <div class="container">
        <div class="row g-2">
            <form method="POST" action="/training-methods/{{ $training_method->id }}">
                @csrf
                @method("PATCH")

                <div class='form-group mt-2'>
                    <div class='flex-column'>
                        <x-form-label for='name'>Name</x-form-label>
                        <x-form-input name='name' id='name' value="{{ $training_method->name }}" required/>
                        <x-form-error name='name'></x-form-error>
                    </div>

                    <div class='form-group mt-2'>
                        <x-form-label for='description'>Description</x-form-label>
                        <textarea
                            name="description"
                            id="description"
                            class="form-control"
                            rows="5"
                            required>
                            {{ $training_method->description }}
                         </textarea>
                        <x-form-error name='description'></x-form-error>
                    </div>

                    <div class='form-group mt-2'>
                        <x-form-label for='image'>Image</x-form-label>
                        <input type="file" name="image" id="image" class="form-control">
                        <x-form-error name='image'></x-form-error>
                    </div>

                    <div class='form-group mt-2'>
                        <x-form-label for='trainers'>Trainers</x-form-label>
                        <select class='form-select' name='trainers[]' id='trainers' multiple>
                            @foreach ($trainers as $trainer)
                                <option value='{{ $trainer->id }}'
                                @if ($training_method->trainers->contains($trainer->id)) selected @endif
                                    >{{ $trainer->name }}</option>
                            @endforeach
                        </select>
                        <x-form-error name='trainers'></x-form-error>
                    </div>

                </div>
                <div class='container mt-3 ps-0'>
                    <div class='row'>
                        <div class='col d-flex justify-content-between'>
                            @if(count($training_method->trainings) === 0)
                                <button form='delete-form' class='btn btn-danger'>Delete</button>
                            @endif
                            <div>
                                <a href="/training-methods/{{ $training_method->name }}" type="button" class="btn btn-outline-dark">Cancel</a>
                                <button type='submit' class='btn btn-primary ms-2'>Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <form method='POST' action='/training-methods/ {{ $training_method->id }}' id='delete-form' class='hidden'>
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>
@endsection
