<?php

namespace App\Repositories\TrainingMethodRepository;

use App\Models\TrainingMethod;

interface TrainingMethodRepositoryInterface
{
    public function index();
    public function show(TrainingMethod $trainingMethod);
    public function store(TrainingMethod $trainingMethod, array $trainers);

    public function update(TrainingMethod $trainingMethod, array $trainers);
}
