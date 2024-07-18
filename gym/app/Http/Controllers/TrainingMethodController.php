<?php

namespace App\Http\Controllers;

use App\Models\TrainingMethod;
use App\Models\User;
use App\Repositories\TrainingMethodRepository\TrainingMethodRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class TrainingMethodController extends Controller
{
    public function __construct(private TrainingMethodRepositoryInterface $trainingMethodRepository)
    {
    }

    public function index()
    {
        $training_methods = $this->trainingMethodRepository->index();
        return view('training-methods.index', ['training_methods' => $training_methods]);
    }

    public function create()
    {
        $trainers = User::where('role', 'trainer')->get();
        return view('training-methods.create', ['trainers' => $trainers]);
    }

    public function show(TrainingMethod $trainingMethod)
    {
        $training_method = $this->trainingMethodRepository->show($trainingMethod);
        return view('training-methods.show', ['training_method' => $training_method]);
    }

    public function store(TrainingMethod $trainingMethod)
    {
        request()->validate([
            'name' => 'required',
            'description' => 'required',
            'trainers' => 'required|array',
            'trainers.*' => 'exists:App\Models\User,id',
            'image' => 'required|image|mimes:jpg|max:2048',
        ]);

        $fileName = "training-method-" . request('name') . "-card.jpg";

        if (request()->file('image')->isValid()) {

            $imagePath = request()->file('image')->storeAs('public/images', $fileName);

            $url = Storage::url($imagePath);
        }

        $trainingMethod->name = request('name');
        $trainingMethod->description = request('description');
        $trainingMethod->image = $fileName;

        $trainers = request('trainers');

        $this->trainingMethodRepository->store($trainingMethod, $trainers);

        return redirect('/training-methods');
    }

    public function edit(TrainingMethod $trainingMethod)
    {
        $trainers = User::where('role', 'trainer')->get();

        //$trainingMethod = TrainingMethod::with('trainers')->get();

        //return response()->json($trainingMethod);
        return view('training-methods.edit', [
            'training_method' => $trainingMethod,
            'trainers' => $trainers]);
    }

    public function update(TrainingMethod $trainingMethod)
    {
        request()->validate([
            'name' => 'required',
            'description' => 'required',
            'trainers' => 'required|array',
            'trainers.*' => 'exists:App\Models\User,id',
        ]);

        $trainingMethod->name = request('name');
        $trainingMethod->name = request('description');
        $trainers = request('trainers');

        $this->trainingMethodRepository->update($trainingMethod, $trainers);
        return redirect('/training-methods');
    }

    public function destroy(TrainingMethod $trainingMethod)
    {
        $trainingMethod->delete();
        return redirect('/training-methods');
    }
}
