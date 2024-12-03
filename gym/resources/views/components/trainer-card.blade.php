@props(['name', 'email', 'training_methods', 'votes', 'id'])

<div class="col-md-4 col-sm-12">
    <div class="card">
        <div class="card-body">
            <p class="card-text">Name: {{ $name }}</p>
            <p class="card-text">Email: {{ $email }}</p>
            <p class="card-text">Training methods: {{ implode(", ", $training_methods) }}</p>
            <p class="card-text">Votes: {{ $votes }}</p>
            @if(!request()->is('training-methods/*'))
                <a href="/trainers/{{ $id }}" class="btn btn-outline-dark">More</a>
            @endif
        </div>
    </div>
</div>
