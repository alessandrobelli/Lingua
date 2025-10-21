<?php

namespace alessandrobelli\Lingua\Tests\Feature\Models;

use alessandrobelli\Lingua\Tests\TestCase;
use alessandrobelli\Lingua\Translation;
use PHPUnit\Framework\Attributes\Test;

class TranslationTest extends TestCase
{
    #[Test]
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
