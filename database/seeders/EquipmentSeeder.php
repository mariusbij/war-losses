<?php

namespace Database\Seeders;

use App\Services\EquipmentService\Models\Equipment;
use Illuminate\Database\Seeder;

class EquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Equipment::factory(50)->create();
    }
}
