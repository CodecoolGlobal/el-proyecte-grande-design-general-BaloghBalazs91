@props(['start', 'trainer', 'training_method', 'id', 'capacity', 'number_of_participants'])

<div class="col-md-4 col-sm-12">
    <div class="card">
        <div class="card-body">
            <p class="card-text">Start: {{ $start }}</p>
            <p class="card-text">Training method: {{ $training_method }}</p>
            <p class="card-text">Trainer: {{ $trainer }}</p>
            <p class="card-text">Number of places: {{ $number_of_participants }} / {{ $capacity }}</p>
            <a href="/trainings/{{$id}}" class="btn btn-outline-dark">More</a>
            {{-- <a href="training-methods/{{ lcfirst($title) }}" class="btn btn-primary">More</a> --}}
        </div>
    </div>
</div>
