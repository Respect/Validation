<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Attributes\Template;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Helpers\CanValidateDateTime;

use function date;
use function is_scalar;
use function preg_match;
use function sprintf;
use function strtotime;

#[Template(
    '{{name}} must be a valid time in the format {{sample}}',
    '{{name}} must not be a valid time in the format {{sample}}',
)]
final class Time extends AbstractRule
{
    use CanValidateDateTime;

    /**
     * @throws ComponentException
     */
    public function __construct(
        private readonly string $format = 'H:i:s'
    ) {
        if (!preg_match('/^[gGhHisuvaA\W]+$/', $format)) {
            throw new ComponentException(sprintf('"%s" is not a valid date format', $format));
        }
    }

    public function validate(mixed $input): bool
    {
        if (!is_scalar($input)) {
            return false;
        }

        return $this->isDateTime($this->format, (string) $input);
    }

    /**
     * @return array<string, string>
     */
    public function getParams(): array
    {
        return ['sample' => date($this->format, strtotime('23:59:59'))];
    }
}
