<?php

namespace App\Http\Requests\Tickets;

use Illuminate\Foundation\Http\FormRequest;

class AttachRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * Allow only if ticket hasn't closed.
     *
     * @return bool
     */
    public function authorize()
    {
        $ticket = $this->route('ticket');
        return !$ticket->isClosed() && $ticket->canSee();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'attachments' => 'required|array',
            'attachments.*' => 'file',
        ];
    }
}
