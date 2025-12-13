<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Tenant;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create tenants
        $tenant1 = Tenant::create([
            'name' => 'BBC News',
            'slug' => 'bbc-news',
            'domain' => 'bbc.localhost',
        ]);

        $tenant2 = Tenant::create([
            'name' => 'CNN News',
            'slug' => 'cnn-news',
            'domain' => 'cnn.localhost',
        ]);

        // Seed roles and permissions
        $this->call(RolePermissionSeeder::class);

        // Create users for tenant 1
        $admin1 = User::create([
            'name' => 'BBC Admin',
            'email' => 'admin@bbc.com',
            'password' => bcrypt('password'),
            'tenant_id' => $tenant1->id,
        ]);
        $admin1->assignRole('admin');

        $editor1 = User::create([
            'name' => 'BBC Editor',
            'email' => 'editor@bbc.com',
            'password' => bcrypt('password'),
            'tenant_id' => $tenant1->id,
        ]);
        $editor1->assignRole('editor');

        $author1 = User::create([
            'name' => 'BBC Author',
            'email' => 'author@bbc.com',
            'password' => bcrypt('password'),
            'tenant_id' => $tenant1->id,
        ]);
        $author1->assignRole('author');

        // Create users for tenant 2
        $admin2 = User::create([
            'name' => 'CNN Admin',
            'email' => 'admin@cnn.com',
            'password' => bcrypt('password'),
            'tenant_id' => $tenant2->id,
        ]);
        $admin2->assignRole('admin');

        // Create categories for tenant 1
        $cat1 = Category::create([
            'name' => 'Technology',
            'slug' => 'technology',
            'tenant_id' => $tenant1->id,
        ]);

        $cat2 = Category::create([
            'name' => 'Sports',
            'slug' => 'sports',
            'tenant_id' => $tenant1->id,
        ]);

        // Create categories for tenant 2
        $cat3 = Category::create([
            'name' => 'Politics',
            'slug' => 'politics',
            'tenant_id' => $tenant2->id,
        ]);

        // Create posts for tenant 1
        Post::create([
            'title' => 'Latest Tech News',
            'body' => 'This is the latest technology news from BBC.',
            'user_id' => $admin1->id,
            'category_id' => $cat1->id,
            'tenant_id' => $tenant1->id,
        ]);

        Post::create([
            'title' => 'Sports Update',
            'body' => 'Breaking sports news from around the world.',
            'user_id' => $editor1->id,
            'category_id' => $cat2->id,
            'tenant_id' => $tenant1->id,
        ]);

        // Create posts for tenant 2
        Post::create([
            'title' => 'Political Headlines',
            'body' => 'Latest political developments from CNN.',
            'user_id' => $admin2->id,
            'category_id' => $cat3->id,
            'tenant_id' => $tenant2->id,
        ]);
    }
}
