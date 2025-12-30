<?php

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Rules\Core\FilteredString;

use function ctype_print;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must contain only printable characters',
    '{{subject}} must not contain printable characters',
    self::TEMPLATE_STANDARD,
)]
#[Template(
    '{{subject}} must contain only printable characters and {{additionalChars}}',
    '{{subject}} must not contain printable characters or {{additionalChars}}',
    self::TEMPLATE_EXTRA,
)]
final class Printable extends FilteredString
{
    protected function isValid(string $input): bool
    {
        return ctype_print($input);
    }
}
