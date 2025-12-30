<?php

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Rules\Core\Simple;

use function is_float;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be float',
    '{{subject}} must not be float',
)]
final class FloatType extends Simple
{
    public function isValid(mixed $input): bool
    {
        return is_float($input);
    }
}
