<?php

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Rules\Core\Simple;

use function is_resource;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be a resource',
    '{{subject}} must not be a resource',
)]
final class ResourceType extends Simple
{
    public function isValid(mixed $input): bool
    {
        return is_resource($input);
    }
}
