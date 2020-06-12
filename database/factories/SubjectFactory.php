<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Subject;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Subject::class, function (Faker $faker) {
    return [
        'title' => $faker->randomElement($array = array ('English','Mathematics','Physics', 'Biology', 'Chemistry')),
    ];
});

