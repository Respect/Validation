<?php

declare(strict_types=1);

namespace Respect\Validation;

interface ValidatorFactory
{
    public function create(): Validator;
}
