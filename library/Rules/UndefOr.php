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
use Respect\Validation\Rules\Core\Wrapper;

#[Template(
    'The value must be undefined',
    'The value must not be undefined',
    self::TEMPLATE_STANDARD,
)]
#[Template(
    '{{name}} must be undefined',
    '{{name}} must not be undefined',
    self::TEMPLATE_NAMED,
)]
final class UndefOr extends Wrapper
{
    use CanValidateUndefined;

    public const TEMPLATE_NAMED = '__named__';

    public function evaluate(mixed $input): Result
    {
        if (!$this->isUndefined($input)) {
            return $this->rule->evaluate($input)->withPrefixedId('undefOr');
        }

        if ($this->getName()) {
            return Result::passed($input, $this, [], self::TEMPLATE_NAMED);
        }

        return Result::passed($input, $this);
    }
}
