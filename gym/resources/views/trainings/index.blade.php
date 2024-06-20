@extends('layout')

@section('title', 'Training list')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col d-flex justify-content-between align-content-start">
                <h1>Trainings</h1>
                <a href="/trainings/create" class="btn btn-primary">New</a>
            </div>
        </div>
    </div>
    <div class="container mt-3">
        <div class="row g-2">
            @foreach ($trainings as $training)
                <x-training-card
                    :trainer="$training->trainer->name"
                    :training_method="$training->trainingMethod->name"
                    :start="$training->start"
                    :id="$training->id"
                    :capacity="$training->capacity"
                    :number_of_participants="count($training->trainees)">
                </x-training-card>
            @endforeach
        </div>
    </div>
@endsection
