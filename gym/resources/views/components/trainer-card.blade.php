@props(['name' => $name, 'voteRate' => $voteRate])

<div class="col-md-4 col-sm-12">
    <div class="card">
        <img src="" class="card-img-top"  alt="...">
        <div class="card-body">
            <h5 class="card-title"> {{ $name }}</h5>
            <p>Vote rate: {{ $voteRate }}</p>
        </div>
    </div>
</div>
