<?php

namespace Support\Repositories;

interface RepositoryContract
{
    public function getModelClass(): string;

    public function getResourceClass(): string;
}
