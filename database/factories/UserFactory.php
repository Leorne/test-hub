<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

//User factory
$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});


//Test factory
$factory->define(App\Test::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'about' => $faker->text(),
    ];
});

//Tag factory
$factory->define(App\Tag::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'approved' => true
    ];
});


//Question factory
$factory->define(App\TestQuestion::class, function (Faker $faker) {
    $test = factory('App\Test')->create();
    return [
        'test_id' => $test->id,
        'question_body' => $faker->text,
        'question_type' => '',
        'question_points' => $faker->numberBetween(1,10)
    ];
});
