<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreOrderRequest extends FormRequest
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
            'card' => 'array',
            'card.cards' =>'array',
            'card.cards.*' =>[ 'integer',Rule::exists('goods','id')],
            'card.quantity' => 'array',
            'card.quantity.*' =>[ 'integer']
        ];
    }
}
