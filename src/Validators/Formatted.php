<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\StringFormatter\Formatter;
use Respect\Validation\Result;
use Respect\Validation\Validator;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
final readonly class Formatted implements Validator
{
    public function __construct(
        private Formatter $formatter,
        private Validator $validator,
    ) {
    }

    public function evaluate(mixed $input): Result
    {
        $stringVal = new StringVal();
        $stringValResult = $stringVal->evaluate($input);
        if (!$stringValResult->hasPassed) {
            return $stringValResult->withNameFrom($this->validator)->withIdFrom($this->validator);
        }

        return $this->validator->evaluate($input)->withInput($this->formatter->format((string) $input));
    }
}
