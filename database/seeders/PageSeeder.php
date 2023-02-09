<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Page::create([
            'title' => 'Imprint',
            'slug' => str()->slug('imprint'),
            'image' => '',
            'content' => fake()->text(200),
            'status' => true,
        ]);
        Page::create([
            'title' => 'Data privacy',
            'slug' => str()->slug('data-privacy'),
            'image' => '',
            'content' => fake()->text(200),
            'status' => true,
        ]);
        Page::create([
            'title' => 'Terms & conditions',
            'slug' => str()->slug('terms-conditions'),
            'image' => '',
            'content' => fake()->text(200),
            'status' => true,
        ]);
    }
}
