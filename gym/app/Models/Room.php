<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Room extends Model
{
        use HasFactory;

    protected $fillable = [
        'name',
    ];

    protected $hidden = [
    ];

    protected function casts(): array
    {
        return [

        ];
    }

    public function trainings()
    {
        return $this->hasMany(Training::class);
    }

}
