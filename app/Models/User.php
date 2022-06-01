<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return HasMany
     */
    public function sentRequests(): HasMany
    {
        return $this->hasMany(Connection::class, 'user_from_id', 'id')
            ->whereStatus(Connection::STATUS_PENDING);
    }

    /**
     * @return HasMany
     */
    public function receivedRequests(): HasMany
    {
        return $this->hasMany(Connection::class, 'user_to_id', 'id')
            ->whereStatus(Connection::STATUS_PENDING);
    }


    /**
     * @return HasMany
     */
    public function receivedConnections(): HasMany
    {
        return $this->hasMany(Connection::class, 'user_to_id', 'id')
            ->whereStatus(Connection::STATUS_ACCEPTED);
    }

    /**
     * @return HasMany
     */
    public function acceptedConnections(): HasMany
    {
        return $this->hasMany(Connection::class, 'user_from_id', 'id')
            ->whereStatus(Connection::STATUS_ACCEPTED);
    }

    /**
     * @return Builder
     */
    public function connections()
    {
        return User::with(['receivedConnections', 'acceptedConnections'])
            ->whereHas('acceptedConnections',
                fn($q) => $q->where('user_to_id', $this->id)
            )
            ->orWhereHas('receivedConnections',
                fn($q) => $q->where('user_from_id', $this->id)
            );
    }

    /**
     * @return mixed
     */
    public function suggestions()
    {
        return User::where('id', '<>', $this->id)
            ->whereDoesntHave('acceptedConnections',
                fn($q) => $q->where('user_to_id', $this->id)
            )->whereDoesntHave('receivedConnections',
                fn($q) => $q->where('user_from_id', $this->id)
            )->whereDoesntHave('sentRequests',
                fn($q) => $q->where('user_to_id', $this->id)
            )->whereDoesntHave('receivedRequests',
                fn($q) => $q->where('user_from_id', $this->id)
            );
    }
}
