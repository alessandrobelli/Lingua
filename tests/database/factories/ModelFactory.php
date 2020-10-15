<?php

use alessandrobelli\Lingua\Tests\User;
use alessandrobelli\Lingua\Translation;
use Faker\Generator;

/* @var Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Translation::class, function (Generator $faker) {
    return [
        'string' => $faker->word,
        'file' => $faker->url,
        'project' => $faker->domainName,
        'locales' => $faker->paragraph,
    ];
});
$factory->define(User::class, function (Generator $faker, $params) {
    $email = $faker->email;

    return [
        'name' => $faker->name,
        'email' => $email,
        'password' => bcrypt('secret'),
        'linguaprojects' => "",
        'email_verified_at' => $faker->date('now'),
    ];
});
