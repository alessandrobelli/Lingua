<?php

namespace alessandrobelli\Lingua\Tests\Feature\Models;

use alessandrobelli\Lingua\Tests\TestCase;
use alessandrobelli\Lingua\Translation;

class TranslationTest extends TestCase
{
    /** @test */
    public function it_can_create_a_model()
    {
        /** @var Translation $model */
        $model = Translation::create(['string' => 'Login']);
        if (intval(app()->version()) > 6) {
            $this->assertDatabaseCount('translations', 1);
        }
        $this->assertEquals('Login', $model->string);
    }
}
