<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use Respect\Validation\Exceptions\InvalidRuleConstructorException;
use Respect\Validation\Helpers\CanValidateDateTime;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Rule;

use function date;
use function is_scalar;
use function preg_match;
use function strtotime;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be a valid date in the format {{sample}}',
    '{{subject}} must not be a valid date in the format {{sample}}',
)]
final readonly class Date implements Rule
{
    use CanValidateDateTime;

    public function __construct(
        private string $format = 'Y-m-d',
    ) {
        if (!preg_match('/^[djSFmMnYy\W]+$/', $format)) {
            throw new InvalidRuleConstructorException('"%s" is not a valid date format', $format);
        }
    }

    public function evaluate(mixed $input): Result
    {
        $parameters = ['sample' => date($this->format, strtotime('2005-12-30'))];
        if (!is_scalar($input)) {
            return Result::failed($input, $this, $parameters);
        }

        return Result::of($this->isDateTime($this->format, (string) $input), $input, $this, $parameters);
    }
}
