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
    'The value must be defined',
    'The value must be undefined',
    self::TEMPLATE_STANDARD,
)]
#[Template(
    '{{name}} must be defined',
    '{{name}} must be undefined',
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
