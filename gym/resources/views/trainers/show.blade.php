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
            <h2 class="mt-5">Trainings</h2>
            <div class="row g-2">
                @foreach($trainer->trainings as $training)
                    <x-training-card
                        :training="$training">
                    </x-training-card>
                @endforeach
            </div>
        </div>
    </div>

@endsection
