<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateLocationRequest;
use App\Services\EquipmentService\EquipmentService;
use App\Services\EquipmentService\Repositories\EquipmentRepositoryInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    public function __construct(private readonly EquipmentRepositoryInterface $equipmentRepository)
    {
    }

    public function index(Request $request): View
    {
        $equipmentService = new EquipmentService($request);
        $equipment = $equipmentService->filterEquipment();

        return view('app')
            ->with('equipment', $equipment)
            ->with('categories', $this->equipmentRepository->getAllCategories());
    }

    public function show(int $id): View
    {
        return view('single')
            ->with('equipment', $this->equipmentRepository->findOrFail($id));
    }

    public function updateLocation(UpdateLocationRequest $request): RedirectResponse
    {
        $success = $this->equipmentRepository->updateLocation($request);

        if (!$success) {
            return back()
                ->with('failure', 'The equipment location updating failed!');
        } else {
            return back()
                ->with('success', 'The equipment location was successful!');
        }
    }
}
