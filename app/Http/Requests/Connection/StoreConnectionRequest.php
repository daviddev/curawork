<?php

namespace App\Http\Requests\Connection;

use App\Rules\UniqueConnection;
use Illuminate\Foundation\Http\FormRequest;

class StoreConnectionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'user_to_id' => [
                'required',
                'integer',
                'min:1',
                'exists:users,id',
                new UniqueConnection(auth()->id(), $this->user_to_id),
            ],
        ];
    }
}
