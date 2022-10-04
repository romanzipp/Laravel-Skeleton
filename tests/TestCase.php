<?php

namespace Tests;

use Faker\Generator;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Http\Request;
use Tests\Support\Repository\RepositoryTestModel;

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
        $builder = $app['db']->connection()->getSchemaBuilder();

        RepositoryTestModel::migrate($builder);
    }

    protected static function assertPropertyExists($object, $property): void
    {
        self::assertTrue(property_exists($object, $property), "Failed asserting that an object has property {$property}");
    }
}
