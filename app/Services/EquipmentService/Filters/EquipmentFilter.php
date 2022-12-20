<?php

namespace App\Services\EquipmentService\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class EquipmentFilter
{
    private array $allowedFilters = [
        'name' => EquipmentNameFilter::class,
        'category_id' => EquipmentCategoryFilter::class,
        'side_country' => EquipmentSideCountryFilter::class,
        'date_from' => EquipmentDateFromFilter::class,
        'date_to' => EquipmentDateToFilter::class,
        'tags' => EquipmentTagsFilter::class
    ];

    public function __construct(private readonly Request $request)
    {
    }

    public function filter(Builder $query): Builder
    {
        $filters = $this->getAllowedFiltersFromRequest();

        foreach ($filters as $filter => $value) {
            if ($value == null) {
                continue;
            }

            $filterInstance = new $this->allowedFilters[$filter];
            $query = $filterInstance->filter($query, $value);
        }
        return $query;
    }

    protected function getAllowedFiltersFromRequest(): array
    {
        return $this->request->only(array_keys($this->allowedFilters));
    }
}
