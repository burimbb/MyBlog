<?php

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
        DB::table('users')->insert([
            'name'     => 'Admin Admin',
            'email'    => 'admin@admin.com',
            'password' => bcrypt('12345678'),
        ]);

        factory('App\Category', 5)->create();
        factory('App\Post', 50)->create();
        factory('App\Tag', 10)->create();
        // $this->call(UsersTableSeeder::class);
        // Get all the roles attaching up to 3 random roles to each user
        $tags = App\Tag::all();

        // Populate the pivot table
        App\Post::all()->each(function ($post) use ($tags) {
            $post->tags()->attach(
                $tags->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
