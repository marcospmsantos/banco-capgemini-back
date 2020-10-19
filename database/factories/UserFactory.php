<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

$faker = \Faker\Factory::create('pt_BR');
$factory->define(User::class, function () use ($faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => bcrypt('123456'),
        'remember_token' => Str::random(10),
        'avatar' => $faker->imageUrl(),
        'cpf_cnpj' => \App\Helper\Number::getOnlyNumber($faker->cpf),
        'telefone' => $faker->phone,
        'celular' => $faker->phone,
        'sexo' => (rand(1,2) / 2 === 0) ? 'M' : 'F'
    ];
});
