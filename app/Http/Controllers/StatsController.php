<?php

namespace App\Http\Controllers;

use App\Services\EquipmentService\EquipmentService;
use App\Services\EquipmentService\Repositories\EquipmentRepositoryInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    public function __construct(private readonly EquipmentRepositoryInterface $equipmentRepository)
    {
    }

    public function index(Request $request): View
    {
        $equipmentService = new EquipmentService($request);
        $statsDTO = $equipmentService->getStats();

        return view('stats')
            ->with('stats', $statsDTO)
            ->with('categories', $this->equipmentRepository->getAllCategories());
    }
}
