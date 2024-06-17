@extends('layout')

@section('title','Training methods')

@section('content')
    <x-training-methods-layout trainingMethod="us">
        <div class="container">
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
    </x-training-methods-layout>
@endsection
