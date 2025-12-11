<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
        * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Post::factory()->count(50)->create();
    }
}
