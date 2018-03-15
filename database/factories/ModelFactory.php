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

$factory->define(App\Doctor::class, function (Faker\Generator $faker) {
    $specialty = ['cardiologist', 'pediatrician', 'general'];

    return [
        'name' => $faker->name,
        'specialty' => $specialty[array_rand($specialty)],
        'registry' => $faker->unique()->uuid,
    ];
});