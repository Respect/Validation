<?php

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Rules\Core\Simple;

use function is_bool;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be a boolean',
    '{{subject}} must not be a boolean',
)]
final class BoolType extends Simple
{
    public function isValid(mixed $input): bool
    {
        return is_bool($input);
    }
}
