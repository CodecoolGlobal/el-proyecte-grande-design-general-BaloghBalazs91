<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Trainer extends User
{
    protected $fillable = [
        'training_method_id_list',
        'vote_list'
    ];

    protected function casts(): array
    {
        return [
            'training_method_id_list' => 'array',
            'vote_list' => 'array'
        ];
    }
    public function trainingMethodsOfTrainer(): BelongsToMany
    {
        return $this->belongsToMany(TrainingMethod::class);
    }
}
