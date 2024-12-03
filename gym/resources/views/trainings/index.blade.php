@extends('layout')

@section('title', 'Training list')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col d-flex justify-content-between align-content-start">
                <h1>Trainings</h1>
                <a href="/trainings/create" class="btn btn-primary">New</a>
                <h2>{{explode("-", str_replace(" ", "-", $period['start']))[1]}}.{{explode("-", str_replace(" ", "-", $period['start']))[2]}}
                    -
                    {{explode("-", str_replace(" ", "-", $period['end']))[1]}}.{{explode("-", str_replace(" ", "-", $period['end']))[2]}}</h2>
                <div>
                @if($week !== 0)
                <a href="/trainings?week={{$week - 1}}" class="btn btn-primary"><</a>
                @endif
                <a href="/trainings?week={{$week + 1}}" class="btn btn-primary">></a>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-3">
        <div class="row g-2">
            @foreach ($trainings as $training)
                <x-training-card
                    :training="$training">
{{--                    :trainer="$training->trainer->name"--}}
{{--                    :training_method="$training->trainingMethod->name"--}}
{{--                    :start="$training->start"--}}
{{--                    :id="$training->id"--}}
{{--                    :capacity="$training->capacity"--}}
{{--                    :number_of_participants="$training->trainees_count">--}}
                </x-training-card>
            @endforeach
        </div>
    </div>
@endsection
