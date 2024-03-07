<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Helpers\CanValidateDateTime;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Rules\Core\Standard;

use function date;
use function is_scalar;
use function preg_match;
use function sprintf;
use function strtotime;

#[Template(
    '{{name}} must be a valid time in the format {{sample}}',
    '{{name}} must not be a valid time in the format {{sample}}',
)]
final class Time extends Standard
{
    use CanValidateDateTime;

    public function __construct(
        private readonly string $format = 'H:i:s'
    ) {
        if (!preg_match('/^[gGhHisuvaA\W]+$/', $format)) {
            throw new ComponentException(sprintf('"%s" is not a valid date format', $format));
        }
    }

    public function evaluate(mixed $input): Result
    {
        $parameters = ['sample' => date($this->format, strtotime('23:59:59'))];
        if (!is_scalar($input)) {
            return Result::failed($input, $this, $parameters);
        }

        return new Result($this->isDateTime($this->format, (string) $input), $input, $this, $parameters);
    }
}
