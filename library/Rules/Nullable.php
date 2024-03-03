<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Rules\Core\Wrapper;

#[Template(
    'The value must be nullable',
    'The value must not be null',
    self::TEMPLATE_STANDARD,
)]
#[Template(
    '{{name}} must be nullable',
    '{{name}} must not be null',
    self::TEMPLATE_NAMED,
)]
final class Nullable extends Wrapper
{
    public const TEMPLATE_NAMED = '__named__';

    public function evaluate(mixed $input): Result
    {
        if ($input !== null) {
            return parent::evaluate($input);
        }

        if ($this->getName()) {
            return Result::passed($input, $this, [], self::TEMPLATE_NAMED);
        }

        return Result::passed($input, $this);
    }
}
