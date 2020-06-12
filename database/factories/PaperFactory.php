<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Paper;
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

$factory->define(Paper::class, function (Faker $faker) {
    return [
        'subject_id' => $faker->numberBetween(1,4),
        'paper_type_id' => $faker->numberBetween(1,2),
        'status_id' => $faker->numberBetween(1,2),
       ];
});