<?php

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Rules\Core\Simple;

use function is_string;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be a string',
    '{{subject}} must not be a string',
)]
final class StringType extends Simple
{
    public function isValid(mixed $input): bool
    {
        return is_string($input);
    }
}
