<?php

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Rules\Core\Simple;

use function is_numeric;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be a positive number',
    '{{subject}} must not be a positive number',
)]
final class Positive extends Simple
{
    public function isValid(mixed $input): bool
    {
        if (!is_numeric($input)) {
            return false;
        }

        return $input > 0;
    }
}
