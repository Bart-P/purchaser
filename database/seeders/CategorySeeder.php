<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Supplier;
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

        $categories = [
            ['name' => 'Kartonage', 'color' => '#1E88E5'],
            ['name' => 'Metall', 'color' => '#3949AB'],
            ['name' => 'Holz', 'color' => '#00ACC1'],
            ['name' => 'Druck', 'color' => '#43A047'],
            ['name' => 'Werbemittel', 'color' => '#C0CA33'],
            ['name' => 'Messebau', 'color' => '#FFB300'],
            ['name' => 'Plexi', 'color' => '#F4511E'],
        ];

        Category::factory()->createMany($categories);
        $categories = Category::all();
        $supplierIds = Supplier::all()->pluck('id');


        foreach ($supplierIds as $supplier) {
            $category = $categories->random(rand(1, 3));

            foreach ($category as $cat) {
                $cat->suppliers()->attach($supplier);
            }
        }
    }
}
