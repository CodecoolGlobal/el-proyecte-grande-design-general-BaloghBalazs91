<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Trainee extends User
{
    protected $fillable = [
        'subscription_id',
    ];

    protected function casts(): array
    {
        return [

        ];
    }
    public function subscriptionOfTrainee(): BelongsTo
    {
        return $this->belongsTo(Subscription::class);
    }
}
