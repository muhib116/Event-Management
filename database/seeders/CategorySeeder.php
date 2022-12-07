<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private $categories = array(
        array('name' => 'Arts Culture','image' => '/assets/images/svgs/art.svg'),
        array('name' => 'Business','image' => '/assets/images/svgs/business.svg'),
        array('name' => 'Career','image' => '/assets/images/svgs/career.svg'),
        array('name' => 'Charity & Aid', 'image' => '/assets/images/svgs/aid.svg'),
        array('name' => 'Children & Youth', 'image' => '/assets/images/svgs/5.svg'),
    );

    public function run()
    {
        Category::insert($this->categories);
    }
}
