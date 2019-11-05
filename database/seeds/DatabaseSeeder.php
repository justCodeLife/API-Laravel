<?php

use App\Course;
use App\Episode;
use App\User;
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
        // $this->call(UsersTableSeeder::class);
        $user = factory(User::class)->create();
        factory(Course::class, 5)->create(['user_id' => $user->id])->each(function ($course) {
            factory(Episode::class, rand(6, 20))->make()->each(function ($episode, $key) use ($course) {
                $episode->number = $key + 1;
                $course->episodes()->save($episode);
            });
        });

    }
}
