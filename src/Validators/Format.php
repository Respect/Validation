<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\StringFormatter\Formatter;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Validator;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be formatted as {{formatted}}',
    '{{subject}} must not be formatted as {{formatted}}',
)]
final readonly class Format implements Validator
{
    public function __construct(
        private Formatter $formatter,
    ) {
    }

    public function evaluate(mixed $input): Result
    {
        $stringVal = (new StringVal())->evaluate($input);
        if (!$stringVal->hasPassed) {
            return $stringVal->withIdFrom($this);
        }

        $formatted = $this->formatter->format((string) $input);

        return Result::of(
            $formatted === $input,
            $input,
            $this,
            ['formatted' => $formatted],
            self::TEMPLATE_STANDARD,
        );
    }
}
