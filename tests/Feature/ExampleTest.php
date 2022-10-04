<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use DatabaseMigrations;

    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
