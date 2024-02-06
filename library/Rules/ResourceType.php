<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Message\Template;

use function is_resource;

#[Template(
    '{{name}} must be a resource',
    '{{name}} must not be a resource',
)]
final class ResourceType extends AbstractRule
{
    public function validate(mixed $input): bool
    {
        return is_resource($input);
    }
}
