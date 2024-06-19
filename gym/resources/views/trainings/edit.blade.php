@extends('layout')

@section('title', 'Edit training')

@section('content')
    <h1>Edit training</h1>
    <div class='container'>
        <div class='row g-2'>
            <form method='POST' action='/trainings/{{ $training->id }}'>
                @csrf
                @method('PATCH')

                <div class='form-group mt-2'>
                    <div class='flex-column'>
                        <x-form-label for='start'>Start</x-form-label>
                        <x-form-input name='start' id='start' value='{{ $training->start }}' required/>
                        <x-form-error name='start'></x-form-error>
                    </div>

                    <div class='form-group mt-2'>
                        <x-form-label for='duration'>Duration (mins)</x-form-label>
                        <x-form-input name='duration' id='duration' value='{{ $training->duration }}' required/>
                        <x-form-error name='duration'></x-form-error>
                    </div>

                    <div class='form-group mt-2'>
                        <x-form-label for='capacity'>Capacity</x-form-label>
                        <x-form-input name='capacity' id='capacity' value='{{ $training->capacity }}' required/>
                        <x-form-error name='capacity'></x-form-error>
                    </div>

                    <div class='form-group mt-2'>
                        <x-form-label for='training_method_id'>Training method</x-form-label>
                        <select class='form-select' name='training_method_id' id='training_method_id'>
                            @foreach ($training_methods as $training_method)
                                <option value='{{ $training_method->id }}'>{{ $training_method->name }}</option>
                            @endforeach
                        </select>
                        <x-form-error name='training_method_id'></x-form-error>
                    </div>

                    <div class='form-group mt-2'>
                        <x-form-label for='room_id'>Room</x-form-label>
                        <select class='form-select' name='room_id' id='room_id'>
                            @foreach ($rooms as $room)
                                <option value='{{ $room->id }}'>{{ $room->name }}</option>
                            @endforeach
                        </select>
                        <x-form-error name='room_id'></x-form-error>
                    </div>

                    <div class='form-group mt-2'>
                        <x-form-label for='trainer_id'>Trainer</x-form-label>
                        <select class='form-select' name='trainer_id' id='trainer_id'>
                            @foreach ($trainers as $trainer)
                                <option value='{{ $trainer->id }}'>{{ $trainer->name }}</option>
                            @endforeach
                        </select>
                        <x-form-error name='trainer_id'></x-form-error>
                    </div>
                </div>
                <div class='container mt-3 ps-0'>
                    <div class='row'>
                        <div class='col d-flex justify-content-between'>
                            <button form='delete-form' class='btn btn-danger'>Delete</button>
                            <div>
                                <a href='/trainings/{{ $training->id }}' type='button' class='btn btn-outline-dark'>Cancel</a>
                                <button type='submit' class='btn btn-primary ms-2'>Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <form method='POST' action='/trainings/ {{ $training->id }}' id='delete-form' class='hidden'>
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>
@endsection
