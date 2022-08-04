<?php

namespace App\Http\Requests\Tickets;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ShowRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * TODO: Add valdation for guest user.
     *
     * @return bool
     */
    public function authorize()
    {
        if (is_null(Auth::user())) {
            return true;
        }

        return $this->route('ticket')->canSee();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
