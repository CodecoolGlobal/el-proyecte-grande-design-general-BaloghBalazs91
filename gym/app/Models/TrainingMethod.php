<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class TrainingMethod extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $fillable = [
        'name',
        'description',
        'image'
    ];
    protected $hidden = [
    ];
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    # A training method has many trainers
    public function trainers(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'training_method_trainer',
            'training_method_id',
            'user_id');
    }

    # A training method has many trainings.
    public function trainings()
    {
        return $this->hasMany(Training::class);
    }

}
