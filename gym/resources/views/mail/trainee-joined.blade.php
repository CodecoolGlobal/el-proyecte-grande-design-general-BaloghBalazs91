<h2>{{ $training->start }}</h2>
<p>Trainee joined the training: {{ $user->name }}</p>
<p>
    <a href="{{ url('/trainings/' . $training->id) }}">View your training.</a>
</p>
