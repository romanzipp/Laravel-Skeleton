<?php

namespace Support\Repositories\Contracts;

interface RepositoryContract
{
    /**
     * Get the corresponding model class.
     *
     * @see \Support\Models\AbstractModel
     * @return string
     */
    public function getModelClass(): string;

    /**
     * Get the corresponding resource class.
     *
     * @see \Support\Http\Resources\AbstractResource
     * @return string
     */
    public function getResourceClass(): string;
}
