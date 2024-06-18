@props(['training_method', 'start'])

<div class="col-md-4 col-sm-12">
    <div class="card">
        <div class="card-body">
            @if(isset($training_method) && isset($training_method['name']))
                <h5 class="card-title">{{ $training_method['name'] }}</h5>
            @else
                <h5 class="card-title">Unknown Method</h5>
            @endif
            <p class="card-text">{{ $start }}</p>
            {{-- <a href="training-methods/{{ lcfirst($title) }}" class="btn btn-primary">More</a> --}}
        </div>
    </div>
</div>
