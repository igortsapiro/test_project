<?php

use App\Test;
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

$factory->define(Test::class, function (Faker $faker) {
    return [
        'string_field' => $faker->words(3, true),
        'boolean_field' => $faker->boolean(),
        'decimal_field' => $faker->randomFloat(3),
        'timestamp_field' => $faker->dateTimeBetween('-10 years', 'now'), // password
    ];
});
