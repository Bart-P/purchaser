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
            ]
        );

        Supplier::factory(100)->create();
        Address::factory(150)->create();
        Person::factory(125)->create();

        $this->call([CategorySeeder::class]);
        $this->call([TagSeeder::class]);

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
