<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class TestPrueba extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {

        $response = $this->get('/');
        $response->assertStatus();
    }
}
