<?php

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Rules\Core\Simple;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be valid',
    '{{subject}} must be invalid',
)]
final class AlwaysValid extends Simple
{
    public function isValid(mixed $input): bool
    {
        return true;
    }
}
