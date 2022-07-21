<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
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
     * Override parent __construct method to handle password attribute
     *
     * @param array<string, string> $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        // If there is a password in attributes
        // Hash it with a method and replace
        // old unhashed value with recieved one
        if (key_exists('password', $attributes)) {
            $attributes['password'] = $this->hashPassword($attributes['password']);
        }
    }

    /**
     * Returns hashed password by provided string
     *
     * @param string $password
     * @return string
     */
    public function hashPassword(string $password): string
    {
        return Hash::make($password);
    }
}
