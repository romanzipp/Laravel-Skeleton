<?php

namespace Support\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection as BaseResourceCollection;
use Illuminate\Http\Resources\MissingValue;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Support\Collection;
use stdClass;

class ResourceCollection extends BaseResourceCollection
{
    /**
     * The name of the resource being collected.
     *
     * @var string
     */
    public $collects;

    /**
     * Create a new anonymous resource collection.
     *
     * @param mixed $resource
     * @param string $collects
     */
    public function __construct($resource, $collects)
    {
        $this->collects = $collects;

        parent::__construct($resource);
    }

    /**
     * Map the given collection resource into its individual resources.
     *
     * @param mixed $resource
     *
     * @return mixed
     */
    protected function collectResource($resource)
    {
        if ($resource instanceof MissingValue) {
            return $resource;
        }

        if (is_array($resource)) {
            $resource = new Collection($resource);
        }

        $collects = $this->collects();

        if ($collects && ! $resource->first() instanceof $collects) {
            $this->collection = $resource->map(function ($resource) use ($collects) {
                return new $collects($resource);
            });
        } else {
            $this->collection = $resource->toBase();
        }

        return $resource instanceof AbstractPaginator
            ? $resource->setCollection($this->collection)
            : $this->collection;
    }

    /**
     * Convert resource collection to view response.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \stdClass
     */
    public function toView(Request $request): stdClass
    {
        return $this
            ->toResponse($request)
            ->getData();
    }

    /**
     * Create a paginate-aware HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function preparePaginatedResponse($request)
    {
        if ($this->preserveAllQueryParameters) {
            $this->resource->appends($request->query());
        } elseif ( ! is_null($this->queryParameters)) {
            $this->resource->appends($this->queryParameters);
        }

        return (new PaginatedResourceResponse($this))->toResponse($request);
    }
}
