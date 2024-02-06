<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Message\Template;
use stdClass;

use function array_filter;
use function is_array;
use function is_numeric;
use function is_string;
use function trim;

#[Template(
    'The value must not be blank',
    'The value must be blank',
    self::TEMPLATE_STANDARD,
)]
#[Template(
    '{{name}} must not be blank',
    '{{name}} must be blank',
    self::TEMPLATE_NAMED,
)]
final class NotBlank extends AbstractRule
{
    public const TEMPLATE_NAMED = 'named';

    public function validate(mixed $input): bool
    {
        if (is_numeric($input)) {
            return $input != 0;
        }

        if (is_string($input)) {
            $input = trim($input);
        }

        if ($input instanceof stdClass) {
            $input = (array) $input;
        }

        if (is_array($input)) {
            $input = array_filter($input, __METHOD__);
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
