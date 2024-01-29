<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Attributes\Template;

use function is_string;
use function trim;

#[Template(
    'The value must not be empty',
    'The value must be empty',
    self::TEMPLATE_STANDARD,
)]
#[Template(
    '{{name}} must not be empty',
    '{{name}} must be empty',
    self::TEMPLATE_NAMED,
)]
final class NotEmpty extends AbstractRule
{
    public const TEMPLATE_NAMED = 'named';

    public function validate(mixed $input): bool
    {
        if (is_string($input)) {
            $input = trim($input);
        }

        return !empty($input);
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
