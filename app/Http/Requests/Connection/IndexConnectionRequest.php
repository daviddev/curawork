<?php

namespace App\Http\Requests\Connection;

use App\Models\Connection;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IndexConnectionRequest extends FormRequest
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
        $connectionTypes = [
            Connection::TYPE_SUGGESTIONS,
            Connection::TYPE_SENT_REQUESTS,
            Connection::TYPE_RECEIVED_REQUESTS,
            Connection::TYPE_CONNECTIONS,
        ];
        return [
            'page' => ['integer', 'min:1'],
            'per_page' => ['integer', 'min:1'],
            'type' => ['required', 'string', Rule::in($connectionTypes)],
        ];
    }
}
