@extends('layout')

@section('title','Training methods')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col d-flex justify-content-between align-content-start">
                <h1>Training methods</h1>
                <a href="/training-methods/create" class="btn btn-primary">New</a>
            </div>
        </div>
    </div>

    <div class="container mt-3">
        <div class="row g-2">
            @foreach ($training_methods as $training_method)
                <x-training-method-card
                    title="{{ $training_method->name }}"
                    text="{{ $training_method->description }}"
                    image="images/{{ $training_method->image }}">
                </x-training-method-card>
            @endforeach
        </div>
    </div>

@endsection
