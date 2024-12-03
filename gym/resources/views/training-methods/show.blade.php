@extends('layout')

@section('title', ucwords($training_method->name))

@section('content')

    <div>
        <h2>{{ $training_method->name }}</h2>
        <p>{{ $training_method->description }}</p>
        <h2>Our {{ucwords($training_method->name)}} trainers</h2>
        <div class="container">
            <div class="row g-2">
                @foreach($training_method->trainers as $trainer)
                    @php
                        $trainingMethods = $trainer->trainingMethods->pluck('name')->toArray();
                    @endphp
                    <x-trainer-card
                        name="{{ $trainer->name }}"
                        email="{{ $trainer->email }}"
                        :training_methods="$trainingMethods"
                        votes="{{ count($trainer->vote_list) ? array_sum($trainer->vote_list) / count($trainer->vote_list) : 0}}"
                        id="{{ $trainer->id }}">
                    </x-trainer-card>
                @endforeach
            </div>
            <div class="row g-2 mt-3 justify-content-start">
                <div class="col-auto">
                    <a href="/training-methods/{{ $training_method->name }}/edit" class="btn btn-primary px-4">Edit</a>
                </div>
            </div>
            <h2 class="mt-5">Trainings</h2>
            <div class="row g-2">
                @foreach($training_method->trainings as $training)
                    <x-training-card
                        :training="$training">
{{--                        start="{{ $training->start }}"--}}
{{--                        trainer="{{ $training->trainer->name }}"--}}
{{--                        training_method="{{ $training_method->name }}"--}}
{{--                        id="{{ $training->id }}"--}}
{{--                        capacity="{{ $training->capacity }}"--}}
{{--                        number_of_participants="{{ $ }}">--}}
                    </x-training-card>
                @endforeach
            </div>
        </div>
    </div>

@endsection
