<?php

namespace Support\Repositories;

use BadMethodCallException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use RuntimeException;
use stdClass;
use Support\Http\Resources\AbstractResource;
use Support\Http\Resources\ResourceCollection;

abstract class AbstractRepository implements RepositoryContract
{
    protected Builder $query;

    private QueryOptions $options;

    private bool $prepared = false;

    private ?Request $request = null;

    final public function __construct()
    {
        $this->query = app($this->getModelClass())->query();
        $this->options = new QueryOptions();
    }

    /**
     * @return static
     */
    public static function make()
    {
        return new static();
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return static
     */
    public static function api(Request $request)
    {
        return (new static())->setOptionsFromApiRequest($request);
    }

    /**
     * @return static
     */
    public function fresh()
    {
        return new static();
    }

    public function query(): Builder
    {
        return $this->query;
    }

    /**
     * @param int $perPage
     *
     * @return static
     */
    public function paginate(int $perPage = 50): AbstractRepository
    {
        $this->options->paginate = $perPage;

        return $this;
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return static
     */
    protected function setOptionsFromApiRequest(Request $request)
    {
        $this->request = $request;

        if ($limit = $request->query('limit')) {
            $this->options->limit = (int) $limit;
        }

        $this->options->orderBy['created_at'] = 'desc';

        return $this;
    }

    protected function prepare(): Builder
    {
        if ($this->prepared) {
            throw new RuntimeException('Can not prepare a repository query multiple times');
        }

        $this
            ->query
            ->with($this->options->with)
            ->withCount($this->options->withCount);

        if (null !== $this->options->limit) {
            $this->query->limit($this->options->limit);
        }

        foreach ($this->options->orderBy as $column => $direction) {
            $this->query->orderBy($column, $direction);
        }

        $this->prepared = true;

        return $this->query;
    }

    /*
     *--------------------------------------------------------------------------
     * Options
     *--------------------------------------------------------------------------
     */

    /**
     * @param array $relations
     *
     * @return static
     */
    public function with(array $relations)
    {
        $this->options->with = $relations;

        return $this;
    }

    /**
     * @param array $relations
     *
     * @return static
     */
    public function withCount(array $relations)
    {
        $this->options->withCount = $relations;

        return $this;
    }

    /**
     * @param string $field
     * @param string $direction
     *
     * @return static
     */
    public function orderBy(string $field, string $direction)
    {
        $this->options->orderBy[$field] = $direction;

        return $this;
    }

    public static function getCommonRelations(): array
    {
        return [];
    }

    public static function getCommonCountRelations(): array
    {
        return [];
    }

    /*
     *--------------------------------------------------------------------------
     * Query Overrides
     *--------------------------------------------------------------------------
     */

    public function exists(): bool
    {
        return $this->prepare()->exists();
    }

    public function count($columns = ['*']): int
    {
        return $this->prepare()->count($columns);
    }

    /**
     * Execute the query as a "select" statement.
     *
     * @param string[] $columns
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function get($columns = ['*'])
    {
        $query = $this->prepare();

        // Do not apply pagination if a limit has been set
        if (null !== $this->options->paginate && null === $this->options->limit) {
            $results = $query->paginate($this->options->paginate, $columns);

            if (null !== $this->request) {
                $results->appends($this->request->query());
            }

            return $results;
        }

        return $query->get($columns);
    }

    /**
     * Execute the query and get the first result.
     *
     * @param string[] $columns
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function first($columns = ['*'])
    {
        return $this->prepare()->first($columns);
    }

    /**
     * Find a model by its primary key.
     *
     * @param string|int $id
     * @param string[] $columns
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function find($id, array $columns = ['*'])
    {
        return $this->prepare()->find($id, $columns);
    }

    /**
     * Execute a callback over each item while chunking.
     *
     * @param callable $callback
     * @param int $count
     *
     * @return bool
     */
    public function each(callable $callback, int $count = 1000): bool
    {
        return $this->prepare()->each($callback, $count);
    }

    /*
     *--------------------------------------------------------------------------
     * Conversions
     *--------------------------------------------------------------------------
     */

    /**
     * Fetch & convert the repository to a corresponding model resource collection.
     *
     * @return \Support\Http\Resources\ResourceCollection
     */
    public function toResources(): ResourceCollection
    {
        $class = $this->getResourceClass();

        if ( ! method_exists($class, 'collection')) {
            throw new BadMethodCallException('Can not build given repository resource class to collection');
        }

        return $class::collection(
            $this->get()
        );
    }

    /**
     * Fetch the first item and convert to corresponding model resource.
     *
     * @return \Support\Http\Resources\AbstractResource|null
     */
    public function toResource(): ?AbstractResource
    {
        $class = $this->getResourceClass();

        $result = $this->first();

        if (null === $result) {
            return null;
        }

        return new $class($result);
    }

    /**
     * Fetch the first item and convert to stdClass resulting from the model resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \stdClass|null
     */
    public function toObject(Request $request): ?stdClass
    {
        if (null === ($resource = $this->toResource())) {
            return null;
        }

        return $resource->toView($request);
    }

    /**
     * Fetch & convert the repository to a stdClass resulting from the model resource collection.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \stdClass
     */
    public function toObjects(Request $request): stdClass
    {
        return $this->toResources()->toView($request);
    }
}
