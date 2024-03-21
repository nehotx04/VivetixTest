<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketOrderStore extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'buyer_name'   =>  'string|required|max:255',
            'buyer_lastname'   =>  'string|required|max:255',
            'buyer_dni'   =>  'string|required|max:255',
            'ticket_ammount'    =>  'integer|required'
        ];
    }
}
