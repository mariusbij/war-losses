<?php

namespace Tests\Feature;

use App\Services\EquipmentService\EquipmentService;
use App\Services\EquipmentService\Models\Equipment;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Request;
use Tests\TestCase;

class EquipmentFilterTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * @dataProvider filterDataProvider
     */
    public function testEquipmentFilter(string|int $key, string|int $value, int $expected) {

        Equipment::create([
            'name' => 'testing1',
            'side_country' => '10',
            'date' => '2022-10-15',
            'source_url' => 'https://twitter.com/UAWeapons/status/1581908407967092738',
            'category_id' => 2
        ]);

        $request = new Request();
        $request->query->add([
            $key => $value
        ]);

        $equipmentService = new EquipmentService($request);

        $equipment = $equipmentService->filterEquipment()->all();
        $this->assertCount($expected, $equipment);
    }

    public function filterDataProvider(): \Generator
    {
        yield 'first example with provided data' => [
            'key' => 'name',
            'value' => 'testing1',
            'expected' => 1
        ];

        yield 'second example with provided data' => [
            'key' => 'side_country',
            'value' => 10,
            'expected' => 1
        ];

        yield 'third example with provided data' => [
            'key' => 'category_id',
            'value' => 2,
            'expected' => 1
        ];

        yield 'fourth example with provided data' => [
            'key' => 'category_id',
            'value' => 5,
            'expected' => 0
        ];
    }
}
