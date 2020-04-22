<?php

namespace Support\Repositories\Contracts;

interface RepositoryContract
{
    public function getModelClass(): string;

    public function getResourceClass(): string;
}
