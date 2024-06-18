@extends('layout')

@section('title','Training list')

@section('content')
    <h1>Trainings</h1>
    <div class="container">
        <div class="row g-2">
            @foreach ($trainings as $training)
                <x-training-card
                    training_method="{{ $training->training_method }}"
                    start="{{ $training->start }}">
                </x-training-card>
            @endforeach
        </div>
    </div>
@endsection
