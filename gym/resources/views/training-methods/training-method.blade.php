@extends('layout')

@section('title', ucwords($training_method->name))

@section('content')
    <x-training-methods-layout :trainingMethod="$training_method->name">
        <div>
            <h2>{{ $training_method->name }}</h2>
            <p>{{ $training_method->description }}</p>
            <h2>Our {{ucwords($training_method->name)}} trainers</h2>
            <div class="container">
                <div class="row g-2">
                    @foreach($training_method->trainers as $trainer)
                        <x-trainer-card
                            name="{{ $trainer->name }}"
                            voteRate="{{ $trainer->voteRate() }}">
                        </x-trainer-card>
                    @endforeach
                </div>
                <h2>Trainings</h2>
                <div class="row g-2">
                    @foreach($training_method->trainings as $training)
                        <x-training-card
                            start="{{ $training->start }}"
                            trainer="{{$training->trainer->name}}">
                        </x-training-card>
                    @endforeach
                </div>
            </div>
        </div>
    </x-training-methods-layout>
@endsection
