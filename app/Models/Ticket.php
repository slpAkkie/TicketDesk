<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Ticket extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'email',
        'title',
        'category_id',
        'description',
    ];

    /**
     * Override parent __construct method to handle password attribute.
     *
     * @param array<string, string> $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        // If there is attribute and no code for ticket
        // then generate new code. This case probably
        // happens when new Ticket creating only.
        if (count($attributes) && is_null($this->code)) {
            $this->code = $this->generareCode();
        }
    }

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
     * Generate unique code for ticket.
     *
     * @return string
     */
    private function generareCode(): string
    {
        $code = null;

        do {
            $randChars = [];

            for ($i = 0; $i < 4; $i++) {
                $randChars[] = Str::upper(Str::random(4));
            }

            $code = implode('-', $randChars);
        } while (is_null($code) || static::where('code', $code)->count());

        return $code;
    }

    /**
     * Determine if user can close the ticket.
     * TODO: Add validation (Probably use Gates)...
     *
     * @return boolean
     */
    public function canClose(): bool
    {
        return $this->responsible->id === Auth::id();
    }

    /**
     * Returns true if ticket closed.
     *
     * @return boolean
     */
    public function isClosed(): bool
    {
        return $this->status_slug === 'closed';
    }

    /**
     * Close a ticket.
     *
     * @return void
     */
    public function close(): void
    {
        $this->status_slug = 'closed';
        $this->save();
    }

    /**
     * Category of a Ticket.
     *
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(TicketCategory::class, 'category_id', 'id');
    }

    /**
     * Status of a Ticket.
     *
     * @return BelongsTo
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(TicketStatus::class, 'status_slug', 'slug');
    }

    /**
     * Message related to the Ticket.
     *
     * @return HasMany
     */
    public function messages(): HasMany
    {
        return $this->hasMany(TicketMessage::class, 'ticket_id', 'id');
    }

    /**
     * Attachments related to the Ticket.
     *
     * @return HasMany
     */
    public function attachments(): HasMany
    {
        return $this->hasMany(TicketAttachment::class, 'ticket_id', 'id');
    }

    /**
     * User that responsible for the Ticket.
     *
     * @return BelongsTo
     */
    public function responsible(): BelongsTo
    {
        return $this->belongsTo(User::class, 'responsible_id', 'id');
    }
}
