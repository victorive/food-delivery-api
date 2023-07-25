<?php

namespace App\Rules;

use App\Models\Menu;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckMenuQuantityAvailable implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $orderItems = request()->input('order_items');
        $index = explode('.', $attribute)[1];

        $menu = Menu::query()->where('ulid', $orderItems[$index]['menu_ulid'])->first();

        if ($menu && $value > $menu->quantity) {
            $fail('The :attribute exceeds the available stock.');
        }
    }
}
