<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Training extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_training_method',
        'start',
        'duration',
        'id_trainer',
        'id_room',
        'capacity',
        'participants'
    ];
    protected $hidden = [
    ];
    protected function casts(): array
    {
        return [
            'participants' => 'array',
            'created_at' => 'datetime',
            'start' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }
    public function trainingMethod(): BelongsTo
    {
        return $this->belongsTo(TrainingMethod::class, 'id_training_method');
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class, 'id_room');
    }
    public function trainer(): BelongsTo
    {
        return $this->belongsTo(Trainer::class, 'id_trainer');
    }

    public function participants(): BelongsToMany
    {
        return $this->belongsToMany(Trainee::class, '');
    }
}
