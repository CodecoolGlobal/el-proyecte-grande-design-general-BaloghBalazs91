@props(['trainingMethod', 'start'])

<div class="col-md-4 col-sm-12">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $trainingMethod['name'] }}</h5>
            <p class="card-text">{{ $start }}</p>
            {{-- <a href="training-methods/{{ lcfirst($title) }}" class="btn btn-primary">More</a> --}}
        </div>
    </div>
</div>
