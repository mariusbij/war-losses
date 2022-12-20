<?php

namespace Tests\Feature;

use App\Services\EquipmentService\EquipmentService;
use App\Services\EquipmentService\Models\Equipment;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Request;
use Tests\TestCase;

class EquipmentFilterTagTest extends TestCase
{
    use DatabaseTransactions;

    public function testEquipmentFilter() {

        $eq = Equipment::create([
            'name' => 'testingTags',
            'side_country' => '20',
            'date' => '2022-10-30',
            'source_url' => 'https://twitter.com/UAWeapons/status/1581908407967092738',
            'category_id' => 5
        ]);

        $eq->attachTags(['abandoned', 'captured']);

        $eqWithCaptured = Equipment::withAnyTags(['captured'])->get();
        $this->assertCount(1, $eqWithCaptured);

        $eqWithAbandoned = Equipment::withAnyTags(['abandoned'])->get();
        $this->assertCount(1, $eqWithAbandoned);

        $eqWithDestroyed = Equipment::withAnyTags(['destroyed'])->get();
        $this->assertCount(0, $eqWithDestroyed);

        $eqWithDamaged = Equipment::withAnyTags(['damaged'])->get();
        $this->assertCount(0, $eqWithDamaged);
    }
}
