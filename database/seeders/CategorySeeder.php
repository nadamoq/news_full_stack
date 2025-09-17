<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $categ = ['Sport', 'International', 'local'];
        foreach ($categ as $item) {
            Category::create(['name' => $item]);
        }
    }
}
