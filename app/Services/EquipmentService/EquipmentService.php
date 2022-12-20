<?php

namespace App\Services\EquipmentService;

use App\Services\EquipmentService\DTO\StatsDTO;
use App\Services\EquipmentService\Models\Equipment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class EquipmentService
{
    public const LIST_PAGINATION = 15;

    public function __construct(private ?Request $request = null)
    {
    }

    public function filterEquipment(): mixed
    {
        return Equipment::filter($this->request)
            ->orderBy('date', 'DESC')
            ->paginate(self::LIST_PAGINATION)
            ->withQueryString();
    }

    public function getStats(): StatsDTO
    {
        $equipment = Equipment::filter($this->request);
        $total = $equipment->count();
        $destroyed = (clone $equipment)->withAllTags(['destroyed'])->count();
        $damaged = (clone $equipment)->withAllTags(['damaged'])->count();
        $abandoned = (clone $equipment)->withAllTags(['abandoned'])->count();
        $captured = (clone $equipment)->withAllTags(['captured'])->count();

        return new statsDTO($total, $destroyed, $damaged, $captured, $abandoned);
    }

    public function checkForSimilarReported(): Collection
    {
        $data = $this->request->only(['name', 'side_country', 'category_id', 'date']);
        $filterRequest = new Request();
        $daysToCheck = 3;
        $filterRequest->query->add([
            'name' => $data['name'],
            'side_country' => $data['side_country'],
            'category_id' => $data['category_id'],
            'date_from' => date('Y-m-d', strtotime($data['date']. sprintf(' - %d days', $daysToCheck))),
            'date_to' => date('Y-m-d', strtotime($data['date']. sprintf(' + %d days', $daysToCheck)))
        ]);

        return Equipment::filter($filterRequest)->get();
    }
}
