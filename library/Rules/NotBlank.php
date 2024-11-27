<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Rules\Core\Standard;
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
final class NotBlank extends Standard
{
    public const TEMPLATE_NAMED = '__named__';

    public function evaluate(mixed $input): Result
    {
        $template = $input || $this->getName() ? self::TEMPLATE_NAMED : self::TEMPLATE_STANDARD;

        return new Result($this->isBlank($input), $input, $this, [], $template);
    }

    private function isBlank(mixed $input): bool
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
            $input = array_filter($input, fn($value) => $this->isBlank($value));
        }

        return !empty($input);
    }
}
