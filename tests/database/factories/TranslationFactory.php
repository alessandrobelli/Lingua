<?php

namespace alessandrobelli\Lingua\Tests\Database\Factories;

use alessandrobelli\Lingua\Translation;
use Illuminate\Database\Eloquent\Factories\Factory;

class TranslationFactory extends Factory
{
    protected $model = Translation::class;

    public function definition(): array
    {
        return [
            'string' => fake()->word(),
            'file' => fake()->url(),
            'project' => fake()->domainName(),
            'locales' => [],
        ];
    }
}
