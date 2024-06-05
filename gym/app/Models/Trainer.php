<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Trainer extends User
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $fillable = [
        'vote_list'
    ];

    protected function casts(): array
    {
        return [
            'vote_list' => 'array'
        ];
    }
    public function trainingMethods(): BelongsToMany
    {
        return $this->belongsToMany(
            TrainingMethod::class,
            'training_method_trainer',
            'trainer_id',
            'training_method_id');
    }

    public function trainings()
    {
        return $this->hasMany(Training::class);
    }
}
