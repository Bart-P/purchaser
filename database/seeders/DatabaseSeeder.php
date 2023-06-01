<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Inquiry;
use App\Models\InquiryRequest;
use App\Models\Person;
use App\Models\Product;
use App\Models\ProductDescription;
use App\Models\ProductPrice;
use App\Models\Supplier;
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
        Inquiry::factory(10)->create();
        Product::factory(20)->create()
            ->each(function ($product) {
                ProductDescription::factory(1)->create(['product_id' => $product->id, 'lang' => 'DE']);
                ProductDescription::factory(rand(0, 3))->create(['product_id' => $product->id]);
            });
        ProductPrice::factory(20)->create();
        InquiryRequest::factory(5)->create();

        $this->call(CategorySeeder::class);
        $this->call(TagSeeder::class);
    }
}
