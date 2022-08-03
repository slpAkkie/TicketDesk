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
     * Override parent __construct method to handle password attribute.
     *
     * @param array<string, string> $attributes
     */
    public function __construct(array $attributes = [])
    {
        // If there is a password in attributes
        // hash it with a method and replace
        // old unhashed value with new.
        if (key_exists('password', $attributes)) {
            $attributes['password'] = $this->hashPassword($attributes['password']);
        }

        parent::__construct($attributes);
    }

    /**
     * Returns hashed password by provided string.
     *
     * @param string $password
     * @return string
     */
    public function hashPassword(string $password): string
    {
        return Hash::make($password);
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
