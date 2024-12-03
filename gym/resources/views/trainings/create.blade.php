@extends('layout')

@section('title', 'Create a training')

@section('content')
    <h1>Create a training session</h1>
    <div class="container">
        <div class="row g-2">
            <form method="POST" action="/trainings">
                @csrf

                <div class='form-group mt-2'>
                    <div class='flex-column'>
                        <x-form-label for='start'>Start</x-form-label>
                        <x-form-input name='start' id='start' placeholder='2024-07-04T07:48:19.000000Z' required/>
                        <x-form-error name='start'></x-form-error>
                    </div>

                    <div class='form-group mt-2'>
                        <x-form-label for='duration'>Duration (mins)</x-form-label>
                        <x-form-input name='duration' id='duration' placeholder='90' required/>
                        <x-form-error name='duration'></x-form-error>
                    </div>

                    <div class='form-group mt-2'>
                        <x-form-label for='capacity'>Capacity</x-form-label>
                        <x-form-input name='capacity' id='capacity' placeholder='10' required/>
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
                        <select class='form-select' name='trainer_id' id='trainer_id' required disabled>
                            <option value='' disabled selected>Select Trainer</option>
                            @foreach ($trainers as $trainer)
                                @foreach ($trainer->trainingMethods as $method)
                                    <option value='{{ $trainer->id }}' data-training-method='{{ $method->id }}' >{{ $trainer->name }}</option>
                                @endforeach
                            @endforeach
                        </select>
                        <x-form-error name='trainer_id'></x-form-error>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="/trainings" type="button" class="btn btn-outline-dark">Cancel</a>
                    <button type="submit" class="btn btn-primary ms-2">Save</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const trainingMethodSelect = document.getElementById('training_method_id');
            const trainerSelect = document.getElementById('trainer_id');

            trainingMethodSelect.addEventListener('change', function () {
                // Enable the trainer select once a training method is selected
                trainerSelect.disabled = false;

                // Get the selected training method id
                const selectedMethodId = this.value;

                // Filter the trainers based on the selected training method
                const options = trainerSelect.querySelectorAll('option');
                options.forEach(option => {
                    if (option.value) {
                        if (option.dataset.trainingMethod == selectedMethodId) {
                            option.style.display = 'block';
                        } else {
                            option.style.display = 'none';
                        }
                    }
                });
            });

            // Trigger change event to filter trainers on page load if a training method is already selected
            if (trainingMethodSelect.value) {
                const event = new Event('change');
                trainingMethodSelect.dispatchEvent(event);
            }
        });
    </script>
@endsection
