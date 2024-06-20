@extends('layout')

@section('title','Trainers')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col d-flex justify-content-between align-content-start">
                <h1>Trainers</h1>
                <a href="/trainers/create" class="btn btn-primary">New</a>
            </div>
        </div>
    </div>

    <div class="container mt-3">
        <div class="row g-2">
            @foreach ($trainers as $trainer)
                @php
                    $trainingMethods = $trainer->trainingMethods->pluck('name')->toArray();
                @endphp
                <x-trainer-card
                    name="{{ $trainer->name }}"
                    email="{{ $trainer->email }}"
                    :training_methods="$trainingMethods"
                    votes="{{ array_sum($trainer->vote_list) / count($trainer->vote_list) }}"
                    id="{{ $trainer->id }}">
                </x-trainer-card>
            @endforeach
        </div>
    </div>

@endsection
