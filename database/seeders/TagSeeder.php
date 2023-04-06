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

        $category_ids = [1, 2, 3, 4];

        foreach ($category_ids as $cat_id) {
            $current_cat = Category::find($cat_id);
            $suppliers = $current_cat->suppliers()->get();
            $available_tags = [];
            $category_tags = $current_cat->tags()->get();

            if (count($category_tags)) {
                $available_tags = $current_cat->tags()->get()->random(rand(1, 3));
            }

            foreach ($suppliers as $sup) {
                $sup->tags()->attach($available_tags);
            }
        }
    }
}
