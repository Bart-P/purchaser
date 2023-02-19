<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Address;
use App\Models\Category;
use App\Models\Person;
use App\Models\Supplier;
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
        // \App\Models\User::factory(10)->create();

        User::factory()->create(
            [
                'name'     => 'Bartek',
                'email'    => 'bar-p@wp.pl',
                'password' => bcrypt('asdfasdf'),
            ]);

        $categories = [
            'Kartonage',
            'Metall',
            'Holz',
            'Druck',
            'Werbemittel',
            'Messebau',
            'Plexi',
        ];

        foreach ($categories as $category) {
            Category::factory()->create(
                [
                    'name' => $category,
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
            'möbelbaul'         => 3,
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

    }
}