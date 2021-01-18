<?php

namespace Support\Objects;

final class Scope
{
    public string $scope;

    public function __construct(string $scope)
    {
        $this->scope = $scope;
    }

    /**
     * Check if a given scope matches the current scope.
     *
     * @param \Support\Objects\Scope $scope
     *
     * @return bool
     */
    public function is(self $scope): bool
    {
        return $this->scope === $scope->scope;
    }

    /**
     * Get the default scope.
     *
     * @return static
     */
    public static function default(): self
    {
        return new self('default');
    }

    /**
     * get the API scope.
     *
     * @return static
     */
    public static function api(): self
    {
        return new self('api');
    }
}
