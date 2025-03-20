<?php

namespace Tests\Unit;

use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Support\Http\Resources\ResourceCollection;
use Tests\Support\Repository\RepositoryTestModel;
use Tests\Support\Repository\RepositoryTestResource;
use Tests\Support\Repository\TestRepository;
use Tests\TestCase;

class RepositoryTest extends TestCase
{
    use DatabaseMigrations;

    /*
     *--------------------------------------------------------------------------
     * Retrieval methods
     *--------------------------------------------------------------------------
     */

    public function testCountMethod()
    {
        $this->createModels();

        $repository = new TestRepository();

        self::assertSame(3, $repository->count());
    }

    public function testExistsMethod()
    {
        $this->createModels();

        $repository = new TestRepository();

        self::assertTrue($repository->exists());
    }

    public function testGetMethod()
    {
        $this->createModels();

        $repository = new TestRepository();

        self::assertCount(3, $results = $repository->get());
        self::assertInstanceOf(RepositoryTestModel::class, $results[0]);
    }

    public function testFirstMethod()
    {
        $models = $this->createModels();

        $repository = new TestRepository();

        self::assertInstanceOf(RepositoryTestModel::class, $result = $repository->orderBy('created_at', 'asc')->first());
        self::assertSame($models[0]->id, $result->id);
    }

    /*
     *--------------------------------------------------------------------------
     * Paginated
     *--------------------------------------------------------------------------
     */

    public function testPaginatedResult()
    {
        $this->createModels();

        $repository = new TestRepository();
        $repository->paginate(2);

        self::assertInstanceOf(LengthAwarePaginator::class, $results = $repository->get());
        self::assertCount(2, $results->items());
    }

    /*
     *--------------------------------------------------------------------------
     * Resources
     *--------------------------------------------------------------------------
     */

    public function testToSingleResource()
    {
        $this->createModels();

        $repository = new TestRepository();

        self::assertInstanceOf(RepositoryTestResource::class, $result = $repository->toResource());
    }

    public function testToSingleResourcePaginated()
    {
        $this->createModels();

        $repository = new TestRepository();
        $repository->paginate();

        self::assertInstanceOf(RepositoryTestResource::class, $result = $repository->toResource());
    }

    public function testToMultipleResources()
    {
        $this->createModels();

        $repository = new TestRepository();

        self::assertInstanceOf(ResourceCollection::class, $results = $repository->toResources());
        self::assertSame(3, $results->count());
        self::assertInstanceOf(RepositoryTestResource::class, $results[0]);
    }

    public function testToMultipleResourcesPaginated()
    {
        $this->createModels();

        $repository = new TestRepository();
        $repository->paginate();

        self::assertInstanceOf(ResourceCollection::class, $results = $repository->toResources());
        self::assertSame(3, $results->count());
        self::assertInstanceOf(RepositoryTestResource::class, $results[0]);

        self::assertInstanceOf(LengthAwarePaginator::class, $results->resource);
    }

    /*
     *--------------------------------------------------------------------------
     * View objects
     *--------------------------------------------------------------------------
     */

    public function testSingleToObject()
    {
        $models = $this->createModels();

        $repository = new TestRepository();

        self::assertInstanceOf(\stdClass::class, $result = $repository->orderBy('created_at', 'asc')->toObject(self::mockRequest()));
        self::assertSame($models[0]->id, $result->id);
    }

    public function testToMultipleObjects()
    {
        $models = $this->createModels();

        $repository = new TestRepository();

        self::assertInstanceOf(\stdClass::class, $results = $repository->orderBy('created_at', 'asc')->toObjects(self::mockRequest()));
        self::assertTrue(property_exists($results, 'data'));
        self::assertCount(3, $results->data);
        self::assertSame($models[0]->id, $results->data[0]->id);
    }

    public function testSingleToObjectPaginated()
    {
        $models = $this->createModels();

        $repository = new TestRepository();
        $repository->paginate();

        self::assertInstanceOf(\stdClass::class, $result = $repository->orderBy('created_at', 'asc')->toObject(self::mockRequest()));
        self::assertSame($models[0]->id, $result->id);
    }

    public function testToMultipleObjectsPaginated()
    {
        $models = $this->createModels();

        $repository = new TestRepository();
        $repository->paginate();

        self::assertInstanceOf(\stdClass::class, $results = $repository->orderBy('created_at', 'asc')->toObjects(self::mockRequest()));
        self::assertPropertyExists($results, 'data');
        self::assertCount(3, $results->data);
        self::assertSame($models[0]->id, $results->data[0]->id);

        self::assertPropertyExists($results, 'links');
        self::assertPropertyExists($results, 'meta');
    }

    /*
     *--------------------------------------------------------------------------
     * Query options
     *--------------------------------------------------------------------------
     */

    public function testQueryOptionOrder()
    {
        $models = $this->createModels();

        $repository = new TestRepository();
        $repository->orderBy('created_at', 'desc');

        $results = $repository->get();

        self::assertSame($models[0]->id, $results[2]->id);
        self::assertSame($models[1]->id, $results[1]->id);
        self::assertSame($models[2]->id, $results[0]->id);
    }

    private function createModels(): array
    {
        return [
            RepositoryTestModel::query()->create(['created_at' => Carbon::now()->addHours(1)]),
            RepositoryTestModel::query()->create(['created_at' => Carbon::now()->addHours(2)]),
            RepositoryTestModel::query()->create(['created_at' => Carbon::now()->addHours(3)]),
        ];
    }
}
