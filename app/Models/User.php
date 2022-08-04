<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
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
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'admin' => 'boolean',
        'super' => 'boolean',
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
     * Determine if the user has admin rights.
     *
     * @return boolean
     */
    public function isAdmin(): bool
    {
        return $this->admin || $this->super;
    }

    /**
     * Determine if the user has super access rights.
     *
     * @return boolean
     */
    public function isSuper(): bool
    {
        return $this->super;
    }

    /**
     * Returns all users, except authorized one.
     *
     * @return Builder
     */
    public static function allExceptAuth(): Builder
    {
        return static::where('id', '!=', Auth::id());
    }

    /**
     * Returns all not an admins, except authorized one.
     *
     * @return Builder
     */
    public static function notAdmins(): Builder
    {
        return static::where('admin', false)->where('id', '!=', Auth::id());
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
