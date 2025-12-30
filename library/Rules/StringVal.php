<?php

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Rules\Core\Simple;

use function is_object;
use function is_scalar;
use function method_exists;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be a string value',
    '{{subject}} must not be a string value',
)]
final class StringVal extends Simple
{
    public function isValid(mixed $input): bool
    {
        return is_scalar($input) || (is_object($input) && method_exists($input, '__toString'));
    }
}
