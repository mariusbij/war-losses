<?php

namespace App\Services\EquipmentService\Filters;

use Illuminate\Database\Eloquent\Builder;

class EquipmentNameFilter implements EquipmentFilterInterface
{

    public function filter(Builder $query, string $value): Builder
    {
        return $query->where('name', 'LIKE', '%' . $value . '%');
    }
}
