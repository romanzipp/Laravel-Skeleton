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
                $collection->preserveKeys = (new static([]))->preserveKeys === true;
            }
        });
    }
}
