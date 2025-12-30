<?php

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Rules\Core\Simple;

use function filter_var;
use function is_numeric;

use const FILTER_VALIDATE_INT;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be an odd number',
    '{{subject}} must be an even number',
)]
final class Odd extends Simple
{
    public function isValid(mixed $input): bool
    {
        if (!is_numeric($input)) {
            return false;
        }

        if (!filter_var($input, FILTER_VALIDATE_INT)) {
            return false;
        }

        return (int) $input % 2 !== 0;
    }
}
