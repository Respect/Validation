<?php

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use Respect\Validation\Helpers\CanValidateIterable;
use Respect\Validation\Message\Template;
use Respect\Validation\Rules\Core\Simple;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be an iterable value',
    '{{subject}} must not be an iterable value',
)]
final class IterableVal extends Simple
{
    use CanValidateIterable;

    public function isValid(mixed $input): bool
    {
        return $this->isIterable($input);
    }
}
