<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReportNewRequest;
use App\Services\EquipmentService\EquipmentService;
use App\Services\EquipmentService\Repositories\EquipmentRepositoryInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ReportNewController extends Controller
{
    public function __construct(private readonly EquipmentRepositoryInterface $equipmentRepository)
    {
    }

    public function index(): View
    {
        return view('report-new')
            ->with('categories', $this->equipmentRepository->getAllCategories())
            ->with('tags', $this->equipmentRepository->getAllTags());
    }

    public function store(ReportNewRequest $request): RedirectResponse
    {
        $service = new EquipmentService($request);
        $duplicateEquipment = $service->checkForSimilarReported();
        $duplicateIds = $duplicateEquipment->pluck('id');
        $duplicatesShown = (bool) $request->request->get('duplicates_shown');

        if ($duplicateIds->count() > 0 && $duplicatesShown !== true) {
            return back()
                ->with('duplicateIds', $duplicateIds)
                ->withInput();
        }

        $success = $this->equipmentRepository->store($request);

        if (!$success) {
            return back()
                ->with('failure', 'The report has not been submitted!');
        } else {
            return back()
                ->with('success', 'The report have been submitted successfully!');
        }
    }
}
