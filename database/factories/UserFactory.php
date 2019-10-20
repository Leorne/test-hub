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

//TestTag factory
$factory->define(App\TestTag::class, function (Faker $faker) {
    return [
        'test_id' => '',
        'tag_id' => ''
    ];
});

//Question factory
$factory->define(App\Question::class, function (Faker $faker) {
    return [
        'test_id' => '',
        'question_body' => $faker->text,
        'question_type' => '',
        'question_points' => $faker->numberBetween(1, 10),
    ];
});




//Answer factory
$factory->defineAs(App\Answer::class, 'one_answer', function (Faker $faker) {
    $data = [
        'body' => $faker->word,
        'correct' => null
    ];
    return [
        'question_id' => '',
        'answer_data' => $data,
    ];
});

$factory->defineAs(App\Answer::class, 'one_answer.correct', function (Faker $faker){
    $data = [
        'body' => $faker->word,
        'correct' => 1
    ];
    return [
        'question_id' => '',
        'answer_data' => $data,
    ];
});

$factory->defineAs(App\Answer::class, 'many_answers', function (Faker $faker) {
    $data = [
        'body' => $faker->word,
        'correct' => null,
    ];
    return [
        'question_id' => '',
        'answer_data' => $data,
    ];
});

$factory->defineAs(App\Answer::class, 'many_answers.correct', function (Faker $faker) {
    $data = [
        'body' => $faker->word,
        'correct' => 1,
    ];
    return [
        'question_id' => '',
        'answer_data' => $data,
    ];
});

$factory->defineAs(App\Answer::class, 'input_number', function (Faker $faker) {
    $data = [
        'correct' => $faker->numberBetween(0,2020),
        'error_range' => null
    ];
    return [
        'question_id' => '',
        'answer_data' => $data,
    ];
});

$factory->defineAs(App\Answer::class, 'input_string', function (Faker $faker) {
    $data = [
        'correct' => $faker->word,
    ];
    return [
        'question_id' => '',
        'answer_data' => $data,
    ];
});
