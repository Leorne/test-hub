<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Tag;
use App\Models\Test;
use App\Models\Answers\ChooseAnswer;
use App\Models\Answers\InputNumber;
use App\Models\Answers\InputString;
use App\Models\Question;
use App\Models\QuestionAnswer;
use App\Models\TestTag;
use App\Models\User;
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
$factory->define(Test::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'about' => $faker->text(),
        'timer' => null,
        'full_result' => null
    ];
});

//Tag factory
$factory->define(Tag::class, function (Faker $faker) {
    return [
        'value' => $faker->word,
        'approved' => true
    ];
});

//TestTag factory
$factory->define(TestTag::class, function (Faker $faker) {
    return [
        'test_id' => $faker->numberBetween(1, 3000),
        'tag_id' => $faker->numberBetween(1, 3000)
    ];
});

//Question factory
//$factory->define(\App\Models\Question::class, function (Faker $faker) {
//    $types = ['one_answer', 'many_answers', 'input_number', 'input_string'];
//    return [
//        'test_version_id' => 1,
//        'question_body' => $faker->text,
//        'question_type' => $types[array_rand($types)],
//        'question_points' => $faker->numberBetween(1, 10),
//    ];
//});


//Answer factory
//$factory->defineAs(\App\Models\Answer::class, 'one_answer', function (Faker $faker) {
//    $data = [
//        'body' => $faker->word,
//        'correct' => null
//    ];
//    return [
//        'question_id' => '',
//        'answer_data' => $data,
//    ];
//});


$factory->define(Question::class, function (Faker $faker) {
    return [
        'test_version_id' => 1,
        'question_body' => $faker->text(),
        'question_points' => $faker->numberBetween(1, 10),
    ];
});

$factory->define(ChooseAnswer::class, function (Faker $faker) {
    return [
        'answer' => $faker->word,
        'correct' => $faker->boolean(50)
    ];
});

$factory->define(InputNumber::class, function (Faker $faker) {
    return [
        'answer' => $faker->word,
    ];
});

$factory->define(InputString::class, function (Faker $faker) {
    return [
        'answer' => $faker->word,
    ];
});
