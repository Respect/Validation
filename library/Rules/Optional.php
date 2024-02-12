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

#[Template(
    'The value must be optional',
    'The value must not be optional',
    self::TEMPLATE_STANDARD,
)]
#[Template(
    '{{name}} must be optional',
    '{{name}} must not be optional',
    self::TEMPLATE_NAMED,
)]
final class Optional extends Wrapper
{
    use CanValidateUndefined;

    public const TEMPLATE_NAMED = '__named__';

    public function evaluate(mixed $input): Result
    {
        if (!$this->isUndefined($input)) {
            return parent::evaluate($input);
        }

        if ($this->getName()) {
            return Result::passed($input, $this, self::TEMPLATE_NAMED);
        }

        return Result::passed($input, $this);
    }
}
