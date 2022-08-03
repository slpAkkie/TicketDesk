<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ticket extends Model
{
    /**
     * Category of the Ticket.
     *
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(TicketStatus::class, 'status_id', 'id');
    }

    /**
     * Status of the Ticket.
     *
     * @return BelongsTo
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(TicketStatus::class, 'status_id', 'id');
    }

    /**
     * Message related to the Ticket.
     *
     * @return HasMany
     */
    public function messages(): HasMany
    {
        return $this->hasMany(TicketMessages::class, 'ticket_id', 'id');
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
    public function responsilbe(): BelongsTo
    {
        return $this->belongsTo(User::class, 'responsilble_id', 'id');
    }
}
