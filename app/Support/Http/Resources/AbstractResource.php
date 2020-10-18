<?php

namespace Support\Http\Resources;

use Closure;
use Domain\User\Models\User;
use Illuminate\Http\Resources\Json\JsonResource as BaseResource;
use stdClass;

abstract class AbstractResource extends BaseResource
{
    protected function includePolicies(): bool
    {
        return true;
    }

    /**
     * Get the currently authenticated user.
     *
     * @return \Domain\User\Models\User
     */
    protected function user(): User
    {
        return auth()->user();
    }

    public function withPolicies(Closure $callback)
    {
        return $this->mergeWhen($this->includePolicies(), [
            'can' => $callback($this->user()),
        ]);
    }

    /**
     * Merge the model timestamps (created & updated) with resource data.
     *
     * @param array|null $columns
     * @return \Illuminate\Http\Resources\MergeValue|mixed
     */
    public function withDates(?array $columns = null)
    {
        /** @var \Support\Models\AbstractModel $resource */
        $resource = $this->resource;

        return $this->merge(
            $resource->only(
                $columns ?? $resource->getDates()
            )
        );
    }

    /**
     * Convert the resource to a view data object.
     *
     * @param $request
     * @return \stdClass
     */
    public function toView($request): stdClass
    {
        return $this
            ->toResponse($request)
            ->getData()
            ->{static::$wrap};
    }

    public static function collection($resource): ResourceCollection
    {
        return tap(new ResourceCollection($resource, static::class), function ($collection) {
            if (property_exists(static::class, 'preserveKeys')) {
                $collection->preserveKeys = true === (new static([]))->preserveKeys;
            }
        });
    }
}
