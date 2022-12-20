<?php

namespace App\Services\EquipmentService\Filters;

use Illuminate\Database\Eloquent\Builder;

class EquipmentCategoryFilter implements EquipmentFilterInterface
{
    public function filter(Builder $query, string $value): Builder
    {
        return $query->where('category_id', '=', $value);
    }
}
