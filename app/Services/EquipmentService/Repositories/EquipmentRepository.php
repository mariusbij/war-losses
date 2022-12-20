<?php

namespace App\Services\EquipmentService\Repositories;

use App\Http\Requests\ReportNewRequest;
use App\Http\Requests\UpdateLocationRequest;
use App\Services\EquipmentService\Models\Category;
use App\Services\EquipmentService\Models\Equipment;
use Illuminate\Database\Eloquent\Collection;
use Spatie\Tags\Tag;

class EquipmentRepository implements EquipmentRepositoryInterface
{
    public function getAll(): Collection
    {
        return Equipment::all();
    }

    public function updateLocation(UpdateLocationRequest $request): bool
    {
        $equipment = Equipment::find($request->get('equipment_id'));
        $equipment->latitude = $request->validated('latitude');
        $equipment->longitude = $request->validated('longitude');

        return $equipment->save();
    }

    public function findOrFail(int $id): mixed
    {
        return Equipment::findOrFail($id);
    }

    public function store(ReportNewRequest $request): bool
    {
        $validated = $request->validated();
        $equipment = new Equipment();
        $equipment->name = $validated['name'];
        $equipment->side_country = $validated['side_country'];
        $equipment->category_id = $validated['category_id'];
        $equipment->date = $validated['date'];
        $equipment->source_url = $validated['source_url'];

        if ($validated['latitude'] != null && $validated['longitude'] != null) {
            $equipment->latitude = $validated['latitude'];
            $equipment->longitude = $validated['longitude'];
        }

        $success = $equipment->save();

        if ($success) {
            $equipment->attachTags($validated['tags']);
        }
        return $success;
    }

    public function getAllCategories(): Collection
    {
        return Category::all();
    }

    public function getAllTags(): Collection
    {
        return Tag::all();
    }
}
