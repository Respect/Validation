<?php

declare(strict_types=1);

namespace Respect\Validation\Helpers;

use function in_array;

trait CanValidateUndefined
{
    private function isUndefined(mixed $value): bool
    {
        return in_array($value, [null, ''], true);
    }
}
