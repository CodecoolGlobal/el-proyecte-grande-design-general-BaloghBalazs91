<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'vote_list',
        'subscription_id',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function trainingMethods(): BelongsToMany
    {
        return $this->belongsToMany(
            TrainingMethod::class,
            'training_method_user',
            'user_id',
            'training_method_id');
    }

    public function subscription()
    {
        return $this->hasOne(Subscription::class);
    }

    # Trainee belongs to many trainings
    public function participatesOn() : BelongsToMany
    {
        return $this->belongsToMany(
            Training::class,
            'training_user',
            'user_id',
            'training_id'
        );
    }

    # Trainer has many trainings
    public function trainings()
    {
        return $this->hasMany(Training::class);
    }
}
