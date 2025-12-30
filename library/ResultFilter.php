<?php

declare(strict_types=1);

namespace Respect\Validation;

interface ResultFilter
{
    public function filter(Result $result): Result;
}
