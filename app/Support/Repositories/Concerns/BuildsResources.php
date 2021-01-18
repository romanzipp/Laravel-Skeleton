<?php

namespace Support\Repositories\Concerns;

use BadMethodCallException;
use Illuminate\Http\Request;
use stdClass;
use Support\Http\Resources\AbstractResource;
use Support\Http\Resources\ResourceCollection;

trait BuildsResources
{
    /**
     * Fetch the query results and map into a resource collection.
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
            $this->fetch()
        );
    }

    /**
     * Fetch the query results and map into a single resource.
     *
     * @return \Support\Http\Resources\AbstractResource|null
     */
    public function toResource(): ?AbstractResource
    {
        $class = $this->getResourceClass();

        $result = $this->fetch()->first();

        if (null === $result) {
            return null;
        }

        return new $class($result);
    }

    /**
     * Convert the query results into a view data object.
     *
     * @param \Illuminate\Http\Request $request
     * @param bool $collection
     *
     * @return \stdClass|null
     */
    public function toView(Request $request, bool $collection): ?stdClass
    {
        $resources = null;

        if ($collection) {
            return $this->toResources()->toView($request);
        }

        $resource = $this->toResource();

        if (null === $resource) {
            return null;
        }

        return $resource->toView($request);
    }

    /**
     * Convert the query results into a single view object.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \stdClass|null
     */
    public function oneToView(Request $request): ?stdClass
    {
        return $this->toView($request, false);
    }

    /**
     * Convert the query results into a view data object collection.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \stdClass
     */
    public function manyToView(Request $request): stdClass
    {
        return $this->toView($request, true);
    }

    abstract protected function fetch();

    abstract public function getModelClass(): string;

    abstract public function getResourceClass(): string;
}
