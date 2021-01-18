<?php

namespace Support\Http\Resources;

use Closure;
use Domain\User\Models\User;
use Illuminate\Http\Resources\Json\JsonResource as BaseResource;
use Illuminate\Http\Resources\MergeValue;
use Illuminate\Support\Facades\Auth as AuthFacade;
use stdClass;
use Support\Objects\Scope;

abstract class AbstractResource extends BaseResource
{
    public Scope $scope;

    public function __construct($resource, ?Scope $scope = null)
    {
        $this->scope = $scope ?? Scope::default();

        parent::__construct($resource);
    }

    protected function includePolicies(): bool
    {
        return true;
    }

    /**
     * Get the authenticated user.
     *
     * @return \Domain\User\Models\User
     */
    protected function user(): User
    {
        return AuthFacade::user();
    }

    /**
     * Get a merge value if the current scope matches the given value.
     *
     * @param \Support\Objects\Scope $scope
     * @param $data
     *
     * @return \Illuminate\Http\Resources\MergeValue|\Illuminate\Http\Resources\MissingValue|mixed
     */
    public function whenScope(Scope $scope, $data)
    {
        return $this->mergeWhen($this->scope->is($scope), $data);
    }

    /**
     * Get a merge value or missing value to include policies.
     *
     * @param \Closure $callback
     *
     * @return \Illuminate\Http\Resources\MergeValue|\Illuminate\Http\Resources\MissingValue|mixed
     */
    public function withPolicies(Closure $callback)
    {
        return $this->mergeWhen($this->includePolicies(), [
            'can' => $callback($this->user()),
        ]);
    }

    /**
     * Get a merge value of all model dates.
     *
     * @param array|null $columns
     *
     * @return \Illuminate\Http\Resources\MergeValue
     */
    public function withDates(?array $columns = null): MergeValue
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
     * Convert the current resource to stdClass for view usage.
     *
     * @param $request
     *
     * @return \stdClass
     */
    public function toView($request): stdClass
    {
        return $this
            ->toResponse($request)
            ->getData()
            ->{static::$wrap};
    }

    /**
     * Create new resource collection.
     *
     * @param mixed $resource
     * @param \Support\Objects\Scope|null $scope
     *
     * @return \Support\Http\Resources\ResourceCollection
     */
    public static function collection($resource, ?Scope $scope = null): ResourceCollection
    {
        return new ResourceCollection($resource, static::class, $scope);
    }
}
