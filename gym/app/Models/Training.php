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
    public function trainingMethod()
    {
        return $this->hasOne(TrainingMethod::class);
    }

    public function room()
    {
        return $this->hasOne(Room::class);
    }
    public function trainer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_trainer');
    }

    public function participants() : BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'training_user',
            'training_id',
            'user_id'
        );
    }
}
