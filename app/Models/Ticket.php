<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Ticket extends Model
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'code';

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

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
     * Returns a short version of description with ellipses.
     *
     * @return string
     */
    public function shortDescription(): string
    {
        return Str::limit($this->description, 32, '...');
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
     * @param User $user
     * @return boolean
     */
    public function canClose(User $user = null): bool
    {
        if (is_null($this->responsible)) {
            return false;
        }

        /** @var User */
        $user = $user ?? Auth::user();

        return $user->isAdmin() || $this->responsible->id === $user->id;
    }

    /**
     * Determine if user can see ticket.
     *
     * @param User $user
     * @return boolean
     */
    public function canSee(User $user = null): bool
    {
        if (is_null($this->responsible)) {
            return false;
        }

        /** @var User */
        $user = $user ?? Auth::user();

        return $user->isAdmin() || $this->responsible->id === $user->id;
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
     * Returns opened tickets.
     *
     * @return Builder
     */
    public static function opened(): Builder
    {
        return static::whereNot('status_slug', 'closed');
    }

    /**
     * Returns closed tickets.
     *
     * @return Builder
     */
    public static function closed(): Builder
    {
        return static::where('status_slug', 'closed');
    }

    /**
     * Returns true if ticket can be accepted by user.
     *
     * @return boolean
     */
    public function canBeAccepted(): bool
    {
        return !$this->isClosed() && $this->responsible_id === null;
    }

    /**
     * Accept a ticket to the user.
     *
     * @param integer|User $user
     * @return void
     */
    public function accept(int|User $user): void
    {
        $responsible_id = $user;

        if ($user instanceof User) {
            $responsible_id = $user->id;
        }

        $this->responsible_id = $responsible_id;

        $this->save();
    }

    /**
     * Returns accepted and not closed tickets.
     *
     * @return Builder
     */
    public static function accepted(): Builder
    {
        return static::opened()->whereNotNull('responsible_id');
    }

    /**
     * Returns tickets accepted by the user.
     *
     * @param integer|User $user
     * @param bool $opened
     * @return Builder
     */
    public static function acceptedBy(int|User $user, bool $opened = true): Builder
    {
        $ticketsBuilder = $opened ? static::opened() : static::closed();

        return $ticketsBuilder->where('responsible_id', $user instanceof User ? $user->id : $user);
    }

    /**
     * Returns not accepted tickets.
     *
     * @return Builder
     */
    public static function notAccepted(): Builder
    {
        return static::opened()->whereNull('responsible_id');
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
        return $this->hasMany(TicketMessage::class, 'ticket_code', 'code');
    }

    /**
     * Attachments related to the Ticket.
     *
     * @return HasMany
     */
    public function attachments(): HasMany
    {
        return $this->hasMany(TicketAttachment::class, 'ticket_code', 'code');
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
