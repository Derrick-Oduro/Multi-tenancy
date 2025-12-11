<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryNames = ['Technology', 'Health', 'Travel', 'Education', 'Lifestyle', 'Finance', 'Food', 'Entertainment', 'Sports', 'Science'];

        foreach ($categoryNames as $categoryName) {
            DB::table('categories')->insert([
                'name' => $categoryName,
                'slug' => strtolower(str_replace(' ', '-', $categoryName)),
            ]);
        }
    }
}
