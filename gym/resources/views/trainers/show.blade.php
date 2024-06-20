@extends('layout')

@section('title', "Trainer: " . $trainer->name)

@section('content')

    <div>

        <div class="container">
            <div class="row g-2">
                <h2>{{ $trainer->name }}</h2>
                <p>Email: {{ $trainer->email }}</p>
                <p>Votes: {{ array_sum($trainer->vote_list) / count($trainer->vote_list) }}</p>
                <p>Training methods: {{ implode(", ", $trainer->trainingMethods->pluck('name')->toArray()) }}</p>
            </div>
            <div class="row g-2 mt-3 justify-content-start">
                <div class="col-auto">
                    <a href="/training-methods/{{ $trainer->name }}/edit" class="btn btn-primary px-4">Edit</a>
                </div>
            </div>
            <h2 class="mt-5">Trainings</h2>
            <div class="row g-2">
                @foreach($trainer->trainings as $training)
                    <x-training-card
                        start="{{ $training->start }}"
                        trainer="{{ $trainer->name }}"
                        training_method="{{ $training->trainingMethod->name }}"
                        id="{{ $training->id }}"
                        capacity="{{ $training->capacity }}"
                        number_of_participants="{{ $training->trainees_count }}">
                    </x-training-card>
                @endforeach
            </div>
        </div>
    </div>

@endsection
