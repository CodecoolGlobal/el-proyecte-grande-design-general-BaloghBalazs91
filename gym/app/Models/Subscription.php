<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Subscription extends Model
{

    use HasFactory;

    protected $fillable = [
        'type',
        'start',
        'duration',
        'remaining_occasions',
        'user_id'
    ];

    protected function casts(): array
    {
        return [

        ];
    }

    public function trainee() :BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
