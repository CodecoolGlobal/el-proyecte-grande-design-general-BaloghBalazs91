@props(['start' => $start, 'trainer' => $trainer])

<div class="col-md-4 col-sm-12">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"> {{ $start }}</h5>
            <p>Trainer: {{ $trainer }}</p>

            <a href="training-methods/" class="btn btn-primary">Book</a>
        </div>
    </div>
</div>
