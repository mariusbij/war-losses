<?php

namespace App\Services\EquipmentService\Filters;

use Illuminate\Database\Eloquent\Builder;

class EquipmentSideCountryFilter implements EquipmentFilterInterface
{
    public function filter(Builder $query, string $value): Builder
    {
        return $query->where('side_country', '=', $value);
    }
}
