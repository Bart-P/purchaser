<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Supplier;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            ['name' => 'offset', 'category_id' => 1],
            ['name' => 'bis B1', 'category_id' => 1],
            ['name' => 'bis B0', 'category_id' => 1],
            ['name' => 'digital', 'category_id' => 1],
            ['name' => 'thekendisplay', 'category_id' => 1],
            ['name' => 'pulverbeschichten', 'category_id' => 2],
            ['name' => 'lackieren', 'category_id' => 2],
            ['name' => 'draht', 'category_id' => 2],
            ['name' => 'blech', 'category_id' => 2],
            ['name' => 'leichtholz', 'category_id' => 3],
            ['name' => 'möbelbau', 'category_id' => 3],
            ['name' => 'boxen', 'category_id' => 3],
            ['name' => 'lasern', 'category_id' => 3],
            ['name' => 'drucken', 'category_id' => 3],
            ['name' => 'folie', 'category_id' => 4],
            ['name' => 'magnetfolie', 'category_id' => 4],
            ['name' => 'pvc', 'category_id' => 4],
        ];

        Tag::factory()->createMany($tags);

        // TODO -> finish up this function, for now no suppliers are selected.
        //$category_ids = [1, 2, 3, 4];
        //
        // foreach ($category_ids as $cat_id) {
        //     $suppliers = Supplier::all()->where('category_id', 'like', $cat_id);
        //     $available_tags = array_filter($tags, function ($tag) use ($cat_id) {
        //         return $tag['category_id'] === $cat_id;
        //     });
        //
        //     foreach ($suppliers as $sup) {
        //         $sup->tags()->attach($available_tags);
        //     }
        // }
    }
}
