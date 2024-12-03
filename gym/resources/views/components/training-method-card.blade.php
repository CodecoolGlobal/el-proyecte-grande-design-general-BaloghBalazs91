@props(['image' => $image, 'title' => $title, 'text' => $text])

<div class="col-md-4 col-sm-12">
    <div class="card">
        <img src="{{ asset("storage/" . $image) }}" class="card-img-top"  alt="...">
        <div class="card-body">
            <h5 class="card-title"> {{ ucwords($title) }}</h5>
            <p class="card-text"> {{ $text }}</p>
            <a href="training-methods/{{ $title }}" class="btn btn-primary">More</a>
        </div>
    </div>
</div>
