<?php

namespace Database\Seeders;

use App\Services\EquipmentService\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::factory()->create([
            'name' => 'Tanks',
        ]);

        Category::factory()->create([
            'name' => 'Armoured Fighting Vehicles',
        ]);

        Category::factory()->create([
            'name' => 'Infantry Fighting Vehicles',
        ]);

        Category::factory()->create([
            'name' => 'Armoured Personnel Carriers',
        ]);

        Category::factory()->create([
            'name' => 'Mine-Resistant Ambush Protected (MRAP) Vehicles',
        ]);

        Category::factory()->create([
            'name' => 'Infantry Mobility Vehicles',
        ]);

        Category::factory()->create([
            'name' => 'Command Posts And Communications Stations',
        ]);

        Category::factory()->create([
            'name' => 'Engineering Vehicles And Equipment',
        ]);

        Category::factory()->create([
            'name' => 'Self-Propelled Anti-Tank Missile Systems',
        ]);

        Category::factory()->create([
            'name' => 'Heavy Mortars',
        ]);

        Category::factory()->create([
            'name' => 'Artillery Support Vehicles And Equipment',
        ]);

        Category::factory()->create([
            'name' => 'Towed Artillery',
        ]);

        Category::factory()->create([
            'name' => 'Self-Propelled Artillery',
        ]);

        Category::factory()->create([
            'name' => 'Multiple Rocket Launchers',
        ]);

        Category::factory()->create([
            'name' => 'Anti-Aircraft Guns',
        ]);

        Category::factory()->create([
            'name' => 'Self-Propelled Anti-Aircraft Guns',
        ]);

        Category::factory()->create([
            'name' => 'Surface-To-Air Missile Systems',
        ]);

        Category::factory()->create([
            'name' => 'Radars',
        ]);

        Category::factory()->create([
            'name' => 'Jammers And Deception Systems',
        ]);

        Category::factory()->create([
            'name' => 'Aircraft',
        ]);

        Category::factory()->create([
            'name' => 'Helicopters',
        ]);

        Category::factory()->create([
            'name' => 'Unmanned Aerial Vehicles',
        ]);

        Category::factory()->create([
            'name' => 'Naval Ships',
        ]);

        Category::factory()->create([
            'name' => 'Logistics Trains',
        ]);

        Category::factory()->create([
            'name' => 'Trucks, Vehicles and Jeeps',
        ]);
    }
}
