<?php

namespace Tests\Feature\Auth;

use Support\Data\AbstractData;

abstract class AbstractAttempt extends AbstractData
{
    public array $assertErrors = [];

    public function errors(array $errors = []): self
    {
        $this->assertErrors = $errors;

        return $this;
    }
}
