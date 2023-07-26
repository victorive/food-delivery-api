<?php

namespace App\Http\Requests\V1\User;

use App\Rules\CheckMenuQuantityAvailable;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::guard('customer')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'order_items.*.restaurant_ulid' => ['required', 'exists:restaurants,ulid'],
            'order_items.*.menu_ulid' => ['required', 'distinct:strict', 'exists:menus,ulid'],
            'order_items.*.quantity' => ['required', 'integer', new CheckMenuQuantityAvailable],
        ];
    }
}
