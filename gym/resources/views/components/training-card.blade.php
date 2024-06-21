@props(['training'])

<div class="col-md-4 col-sm-12">
    <div class="card">
        <div class="card-body">
            <p class="card-text">Start: {{ $training->start }}</p>
            <p class="card-text">Training method: {{ $training->trainingMethod->name }}</p>
            <p class="card-text">Trainer: {{ $training->trainer->name }}</p>
            <p class="card-text">Number of places: {{ $training->trainees_count }} / {{ $training->capacity }}</p>
            <div class="container">
                <div class="row g-2">
                    <div class="col d-flex">
                        <a href="/trainings/{{ $training->id }}" class="btn btn-outline-dark me-2">More</a>
                        @can('join', $training)
                            <form method="POST" action="/trainings/book/{{ Auth::user()->id }}/{{ $training->id }}">
                                @csrf
                                @method("PATCH")

                                <button class="btn btn-primary me-2">Join</button>
                            </form>
                        {{-- <a href="training-methods/{{ lcfirst($title) }}" class="btn btn-primary">More</a> --}}
                        @endcan
                        @can('cancel', $training)
                            <form method="POST" action="/trainings/cancel/{{ Auth::user()->id }}/{{ $training->id }}" >
                                @csrf
                                @method("PATCH")

                                <button class="btn btn-outline-danger">cancel</button>
                            </form>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
