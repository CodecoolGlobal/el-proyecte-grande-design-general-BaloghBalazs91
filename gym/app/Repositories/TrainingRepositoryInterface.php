<?php
namespace App\Repositories;
use App\Models\Training;
use App\Models\User;
use Illuminate\Http\Request;

interface TrainingRepositoryInterface{
    public function getall();
    public function getTrainingsByWeek(?string $week);
    public function createTraining();
    public function showTraining(Training $training);
    public function storeTraining(Training $training);
    public function editTraining(Training $training);
    public function updateTraining(Training $training);
    public function deleteTraining(Training $training);
    public function joinTrainingById(User $user, Training $training);
    public function getTrainees(User $user, Training $training);

}
