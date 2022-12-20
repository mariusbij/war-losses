<?php

namespace App\Services\EquipmentService\Filters;

use Illuminate\Database\Eloquent\Builder;

interface EquipmentFilterInterface
{
    public function filter(Builder $query, string $value): Builder;
}
