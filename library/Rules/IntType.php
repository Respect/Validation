<?php

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Rules\Core\Simple;

use function is_int;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be an integer',
    '{{subject}} must not be an integer',
)]
final class IntType extends Simple
{
    public function isValid(mixed $input): bool
    {
        return is_int($input);
    }
}
