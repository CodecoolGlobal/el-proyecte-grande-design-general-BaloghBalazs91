@extends('layout')

@section('title', $training->trainingMethod->name)

@section('content')
    <h1>Trainings</h1>
    <div class="container">
        <div class="row g-2">
            <h1>{{ $training->trainingMethod->name }}</h1>
            <h2>Details</h2>
            <h4>Trainer: {{ $training->trainer->name }}</h4>
            <h4>Start: {{ $training->start }}</h4>
            <h4>Free slots: {{ $training->capacity - count($training->trainees) }}</h4>
            <h4>Room: {{ $training->room->name }}</h4>
        </div>
        <div class="row g-2 mt-3 justify-content-start">
            <div class="col-auto">
                <a href="/trainings/{{ $training->id }}/edit" class="btn btn-primary px-4">Edit</a>
            </div>
        </div>
    </div>
@endsection
