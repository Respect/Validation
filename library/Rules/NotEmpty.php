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
final class NotEmpty extends Standard
{
    public const TEMPLATE_NAMED = '__named__';

    public function evaluate(mixed $input): Result
    {
        $template = $input || $this->getName() ? self::TEMPLATE_NAMED : self::TEMPLATE_STANDARD;
        if (is_string($input)) {
            $input = trim($input);
        }

        return new Result(!empty($input), $input, $this, [], $template);
    }
}
