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
            'slug' => str()->slug('Imprint'),
            'image' => '',
            'content' => fake()->text(200),
            'status' => true,
        ]);
        Page::create([
            'title' => 'Data privacy',
            'slug' => str()->slug('Data privacy'),
            'image' => '',
            'content' => fake()->text(200),
            'status' => true,
        ]);
        Page::create([
            'title' => 'Terms & conditions',
            'slug' => str()->slug('Terms & conditions'),
            'image' => '',
            'content' => fake()->text(200),
            'status' => true,
        ]);
    }
}
