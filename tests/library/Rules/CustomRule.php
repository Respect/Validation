<?php

declare(strict_types=1);

namespace Respect\Validation\Test\Rules;

use Respect\Validation\Rules\Core\Simple;

final class CustomRule extends Simple
{
    public function isValid(mixed $input): bool
    {
        return false;
    }
}
