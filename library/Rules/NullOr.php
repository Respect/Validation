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
    'The value must be null',
    'The value must not be null',
    self::TEMPLATE_STANDARD,
)]
#[Template(
    '{{name}} must be null',
    '{{name}} must not be null',
    self::TEMPLATE_NAMED,
)]
final class NullOr extends Wrapper
{
    public const TEMPLATE_NAMED = '__named__';

    public function evaluate(mixed $input): Result
    {
        if ($input !== null) {
            return $this->rule->evaluate($input)->withPrefixedId('nullOr');
        }

        if ($this->getName()) {
            return Result::passed($input, $this, [], self::TEMPLATE_NAMED);
        }

        return Result::passed($input, $this);
    }
}
