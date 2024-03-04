<?php

declare(strict_types=1);

namespace App\Request;

use Hyperf\Validation\Request\FormRequest;
use Hyperf\Validation\Rule;

class ClientsRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'valor' =>'required|integer',
            'tipo' =>[
                'required',
                Rule::in(['c','d']),
            ],
            'descricao' =>'required|string|min:1|max:10',
        ];
    }
}
