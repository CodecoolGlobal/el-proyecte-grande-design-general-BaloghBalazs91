<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class TrainingMethod extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'trainers',
    ];
    protected $hidden = [
    ];
    protected function casts(): array
    {
        return [
            'trainers' => 'array',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }
    public function trainersOfTrainingMethod(): BelongsToMany
    {
        return $this->belongsToMany(Trainer::class);
    }
}
