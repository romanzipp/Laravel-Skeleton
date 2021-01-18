<?php

namespace Tests;

use Faker\Generator;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Http\Request;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        self::setUpDatabase($this->app);
    }

    protected static function faker(): Generator
    {
        return app(Generator::class);
    }

    protected static function mockRequest(): Request
    {
        return Request::create('/');
    }

    protected static function setUpDatabase(Application $app): void
    {
        $app['db']->connection()->getSchemaBuilder()->create('tests__repository_models', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamps();
        });
    }

    protected static function assertPropertyExists($object, $property): void
    {
        self::assertTrue(property_exists($object, $property), "Failed asserting that an object has property {$property}");
    }
}
