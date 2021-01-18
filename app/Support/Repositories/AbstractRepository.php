<?php

namespace Support\Repositories;

use BadMethodCallException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use RuntimeException;
use stdClass;
use Support\Http\Resources\AbstractResource;
use Support\Http\Resources\ResourceCollection;
use Support\Objects\Scope;

abstract class AbstractRepository implements RepositoryContract
{
    public const COMMON_RELATIONS = [];

    public const COMMON_RELATION_COUNTS = [];

    protected Builder $query;

    private QueryOptions $options;

    private bool $prepared = false;

    private ?Request $request = null;

    public function __construct()
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
     * @param int|null $perPage
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

    public function first($columns = ['*'])
    {
        return $this->prepare()->first($columns);
    }

    public function find($id, $columns = ['*'])
    {
        return $this->prepare()->find($id, $columns);
    }

    public function each(callable $callback, $count = 1000): bool
    {
        return $this->prepare()->each($callback, $count);
    }

    /*
     *--------------------------------------------------------------------------
     * Conversions
     *--------------------------------------------------------------------------
     */

    public function toResources(?Scope $scope = null): ResourceCollection
    {
        $class = $this->getResourceClass();

        if ( ! method_exists($class, 'collection')) {
            throw new BadMethodCallException('Can not build given repository resource class to collection');
        }

        return $class::collection(
            $this->get(),
            $scope
        );
    }

    public function toResource(?Scope $scope = null): ?AbstractResource
    {
        $class = $this->getResourceClass();

        $result = $this->first();

        if (null === $result) {
            return null;
        }

        return new $class($result, $scope);
    }

    public function toView(Request $request, bool $collection, ?Scope $scope = null): ?stdClass
    {
        $resources = null;

        if ($collection) {
            return $this->toResources($scope)->toView($request);
        }

        $resource = $this->toResource($scope);

        if (null === $resource) {
            return null;
        }

        return $resource->toView($request);
    }

    public function oneToView(Request $request, ?Scope $scope = null): ?stdClass
    {
        return $this->toView($request, false, $scope);
    }

    public function manyToView(Request $request, ?Scope $scope = null): stdClass
    {
        return $this->toView($request, true, $scope);
    }
}
