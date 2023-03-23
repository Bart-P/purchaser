<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Category;
use App\Models\Person;
use App\Models\Supplier;
use App\Models\SupplierCategoryJunction;
use App\Models\SupplierTagJunction;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create(
            [
                'name'     => 'Bartek',
                'email'    => 'bar-p@wp.pl',
                'password' => bcrypt('asdfasdf'),
            ]);

        $categories = [
            ['name' => 'Kartonage', 'color' => '#1E88E5'],
            ['name' => 'Metall', 'color' => '#3949AB'],
            ['name' => 'Holz', 'color' => '#00ACC1'],
            ['name' => 'Druck', 'color' => '#43A047'],
            ['name' => 'Werbemittel', 'color' => '#C0CA33'],
            ['name' => 'Messebau', 'color' => '#FFB300'],
            ['name' => 'Plexi', 'color' => '#F4511E'],
        ];

        foreach ($categories as $category) {
            Category::factory()->create(
                [
                    'name'  => $category['name'],
                    'color' => $category['color'],
                ]);
        }

        $tags = [
            'offset'            => 1,
            'bis B1'            => 1,
            'bis B0'            => 1,
            'digital'           => 1,
            'thekendisplay'     => 1,
            'pulverbeschichten' => 2,
            'lackieren'         => 2,
            'draht'             => 2,
            'blech'             => 2,
            'leichtholz'        => 3,
            'möbelbau'          => 3,
            'boxen'             => 3,
            'lasern'            => 3,
            'drucken'           => 3,
            'folie'             => 4,
            'magnetfolie'       => 4,
            'pvc'               => 4,
        ];

        $tag_keys = array_keys($tags);
        foreach ($tag_keys as $tag_key) {
            Tag::factory()->create(
                [
                    'name'        => $tag_key,
                    'category_id' => $tags[$tag_key],
                ]);
        };

        Supplier::factory(100)->create();
        Address::factory(150)->create();
        Person::factory(125)->create();

        $supplier_ids = Supplier::all('id');
        $category_ids = Category::all('id');

        foreach ($supplier_ids as $id) {
            $cat_id = $category_ids->random()->id;
            SupplierCategoryJunction::factory()->create(
                [
                    'supplier_id' => $id,
                    'category_id' => $cat_id,
                ]
            );

            $category_tags = Category::find($cat_id)->tags()->get('id');

            if (count($category_tags)) {
                $cat_tag = $category_tags->random()->id;
                SupplierTagJunction::factory()->create(
                    [
                        'supplier_id' => $id,
                        'tag_id'      => $cat_tag,
                    ]
                );
            }
        }
    }
}