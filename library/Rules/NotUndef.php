<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Helpers\CanValidateUndefined;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Rules\Core\Standard;

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
final class NotUndef extends Standard
{
    use CanValidateUndefined;

    public const TEMPLATE_NAMED = '__named__';

    public function evaluate(mixed $input): Result
    {
        return new Result(
            $this->isUndefined($input) === false,
            $input,
            $this,
            [],
            ($input || $this->getName() ? self::TEMPLATE_NAMED : self::TEMPLATE_STANDARD)
        );
    }
}
