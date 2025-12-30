<?php

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Rules\Core\Simple;

use function is_iterable;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be iterable',
    '{{subject}} must not iterable',
)]
final class IterableType extends Simple
{
    public function isValid(mixed $input): bool
    {
        return is_iterable($input);
    }
}
