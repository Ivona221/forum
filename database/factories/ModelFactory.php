<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});


$factory->define(App\Discussion::class, function (Faker\Generator $faker) {



    return [

        'title' => $faker->sentence,
        'slug' => $faker->sentence,
        'category_id'=>\App\Category::all()->random()->id,
        'user_id'=>\App\User::all()->random()->id,

    ];
});

$factory->define(App\Response::class, function (Faker\Generator $faker) {



    return [

        'body' => $faker->sentence,
        'discussion_id'=>\App\Discussion::all()->random()->id,
        'user_id'=>\App\User::all()->random()->id,
        'parent_id'=>0

    ];
});



