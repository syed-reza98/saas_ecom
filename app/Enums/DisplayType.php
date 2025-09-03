<?php

namespace App\Enums;

use App\Traits\HasEnumAccessors;

enum DisplayType: string
{
    use HasEnumAccessors;

    case Default = 'Default';
    case Products = 'Products';
    case Subcategories = 'Subcategories';
    case Both = 'Both';

    // 'Default', 'Products', 'Subcategories', 'Both'

    public function color(): string
    {
        return match ($this->value) {
            'Default' => 'success',
            'Products' => 'warning',
            'Subcategories' => 'danger',
            'Both' => 'gray',
        };
    }
}
