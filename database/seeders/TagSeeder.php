<?php

namespace Database\Seeders;

use App\Services\EquipmentService\Models\Equipment;
use Illuminate\Database\Seeder;
use Spatie\Tags\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::create(['name' => 'destroyed']);
        Tag::create(['name' => 'captured']);
        Tag::create(['name' => 'abandoned']);
        Tag::create(['name' => 'damaged']);

        $equipment = Equipment::all();

        $tags = ['destroyed', 'damaged', 'captured', 'abandoned'];

        foreach ($equipment as $eq) {
            $eq->attachTag($tags[array_rand($tags)]);
            $eq->attachTag($tags[array_rand($tags)]);
        }
    }
}
