<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use DateTimeInterface;
use Respect\Validation\Helpers\CanValidateDateTime;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Rules\Core\Standard;

use function date;
use function is_scalar;
use function strtotime;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{name}} must be a valid date/time',
    '{{name}} must not be a valid date/time',
    self::TEMPLATE_STANDARD,
)]
#[Template(
    '{{name}} must be a valid date/time in the format {{sample}}',
    '{{name}} must not be a valid date/time in the format {{sample}}',
    self::TEMPLATE_FORMAT,
)]
final class DateTime extends Standard
{
    use CanValidateDateTime;

    public const TEMPLATE_FORMAT = '__format__';

    public function __construct(
        private readonly ?string $format = null
    ) {
    }

    public function evaluate(mixed $input): Result
    {
        $template = $this->format !== null ? self::TEMPLATE_FORMAT : self::TEMPLATE_STANDARD;
        $parameters = ['sample' => date($this->format ?: 'c', strtotime('2005-12-30 01:02:03'))];
        if ($input instanceof DateTimeInterface) {
            return new Result($this->format === null, $input, $this, $parameters, $template);
        }

        if (!is_scalar($input)) {
            return Result::failed($input, $this, $parameters, $template);
        }

        if ($this->format === null) {
            return new Result(strtotime((string) $input) !== false, $input, $this, $parameters, $template);
        }

        return new Result($this->isDateTime($this->format, (string) $input), $input, $this, $parameters, $template);
    }
}
