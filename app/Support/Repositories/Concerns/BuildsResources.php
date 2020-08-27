<?php

namespace Support\Repositories\Concerns;

use BadMethodCallException;
use Illuminate\Http\Request;
use stdClass;
use Support\Http\Resources\AbstractResource;
use Support\Http\Resources\ResourceCollection;

trait BuildsResources
{
    public function toResources(): ResourceCollection
    {
        $class = $this->getResourceClass();

        if ( ! method_exists($class, 'collection')) {
            throw new BadMethodCallException("Can not build given repository resource class to collection");
        }

        return $class::collection(
            $this->fetch()
        );
    }

    public function toResource(): ?AbstractResource
    {
        $class = $this->getResourceClass();

        $result = $this->fetch()->first();

        if ($result === null) {
            return null;
        }

        return new $class($result);
    }

    public function toView(Request $request, bool $collection): ?stdClass
    {
        $resources = null;

        if ($collection) {
            return $this->toResources()->toView($request);
        }

        $resource = $this->toResource();

        if ($resource === null) {
            return null;
        }

        return $resource->toView($request);
    }

    public function oneToView(Request $request): ?stdClass
    {
        return $this->toView($request, false);
    }

    public function manyToView(Request $request): stdClass
    {
        return $this->toView($request, true);
    }

    abstract protected function fetch();

    abstract public function getModelClass(): string;

    abstract public function getResourceClass(): string;
}
