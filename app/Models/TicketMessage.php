<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class TicketMessage extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'content',
        'user_id',
    ];

    /**
     * Accessor for created_at column.
     *
     * @return Attribute
     */
    public function createdAt(): Attribute
    {
        return Attribute::make(get: fn ($val) => Carbon::parse($val)->format('Y.m.d H:i:s'));
    }

    /**
     * Accessor for updated_at column.
     *
     * @return Attribute
     */
    public function updatedAt(): Attribute
    {
        return Attribute::make(get: fn ($val) => Carbon::parse($val)->format('Y.m.d H:i:s'));
    }

    /**
     * Responsible user.
     * This will be null if message sent by author.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
