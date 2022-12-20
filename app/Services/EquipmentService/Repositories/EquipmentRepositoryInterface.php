<?php

namespace App\Services\EquipmentService\Repositories;

use App\Http\Requests\ReportNewRequest;
use App\Http\Requests\UpdateLocationRequest;

interface EquipmentRepositoryInterface
{
    public function getAll();
    public function findOrFail(int $id);
    public function store(ReportNewRequest $request);
    public function updateLocation(UpdateLocationRequest $request);
    public function getAllCategories();
    public function getAllTags();
}
