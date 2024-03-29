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
        // Create Inquiries and InquiryRequest for it
        Inquiry::factory(10)->create()
            ->each(function ($inquiry) {
                InquiryRequest::factory(rand(0, 10))->create(['inquiry_id' => $inquiry->id]);
            });
        // Create Products and ProductDescription + ProductPrice for it
        Product::factory(20)->create()
            ->each(function ($product) {
                ProductDescription::factory(1)
                    ->create([
                        'product_id' => $product->id,
                        'lang' => 'DE',
                        'is_main' => true
                    ]);
                ProductDescription::factory(rand(0, 3))
                    ->create(['product_id' => $product->id]);
                ProductPrice::factory(rand(0, 5))
                    ->create(['product_id' => $product->id]);
            });

        $this->call(CategorySeeder::class);
        $this->call(TagSeeder::class);
    }
}