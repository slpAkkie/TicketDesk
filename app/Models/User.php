<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
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
     * Set new password to the User.
     *
     * @param string $password
     * @return static
     */
    public function setPassword(string $password): static
    {
        $this->password = Hash::make($password);

        return $this;
    }

    /**
     * Tickets in which user is responsible.
     *
     * @return HasMany
     */
    public function responsibleIn(): HasMany
    {
        return $this->hasMany(Ticket::class, 'responsible_id', 'id');
    }
}
