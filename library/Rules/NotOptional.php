<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Attributes\Template;
use Respect\Validation\Helpers\CanValidateUndefined;

#[Template(
    'The value must not be optional',
    'The value must be optional',
    self::TEMPLATE_STANDARD,
)]
#[Template(
    '{{name}} must not be optional',
    '{{name}} must be optional',
    self::TEMPLATE_NAMED,
)]
final class NotOptional extends AbstractRule
{
    use CanValidateUndefined;

    public const TEMPLATE_NAMED = 'named';

    public function validate(mixed $input): bool
    {
        return $this->isUndefined($input) === false;
    }

    public function getTemplate(mixed $input): string
    {
        if ($this->template !== null) {
            return $this->template;
        }

        if ($input || $this->getName()) {
            return self::TEMPLATE_NAMED;
        }

        return self::TEMPLATE_STANDARD;
    }
}
