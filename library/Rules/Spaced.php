<?php

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Rules\Core\Simple;

use function is_scalar;
use function preg_match;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must contain at least one whitespace',
    '{{subject}} must not contain whitespaces',
)]
final class Spaced extends Simple
{
    public function isValid(mixed $input): bool
    {
        if (!is_scalar($input)) {
            return false;
        }

        return preg_match('/\s/', (string) $input) > 0;
    }
}
