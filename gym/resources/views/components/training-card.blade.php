@props(['start', 'trainer', 'id'])

<div class="col-md-4 col-sm-12">
    <div class="card">
        <div class="card-body">
            <p class="card-text">Start: {{ $start }}</p>
            <p class="card-text">Trainer: {{ $trainer }}</p>
            <a href="/trainings/{{$id}}" class="btn btn-outline-dark">More</a>
            {{-- <a href="training-methods/{{ lcfirst($title) }}" class="btn btn-primary">More</a> --}}
        </div>
    </div>
</div>
