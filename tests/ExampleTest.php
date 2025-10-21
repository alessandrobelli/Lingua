<?php

namespace alessandrobelli\Lingua\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
