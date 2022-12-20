<?php

namespace App\Services\EquipmentService\Filters;

use Illuminate\Database\Eloquent\Builder;

class EquipmentTagsFilter
{
    public function filter(Builder $query, array $values): Builder
    {
        return $query->withAllTags($values);
    }
}
