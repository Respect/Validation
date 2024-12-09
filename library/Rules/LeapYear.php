<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use DateTimeInterface;
use Respect\Validation\Message\Template;
use Respect\Validation\Rules\Core\Simple;

use function date;
use function is_numeric;
use function is_scalar;
use function sprintf;
use function strtotime;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{name}} must be a valid leap year',
    '{{name}} must not be a leap year',
)]
final class LeapYear extends Simple
{
    protected function isValid(mixed $input): bool
    {
        if (is_numeric($input)) {
            $date = strtotime(sprintf('%d-02-29', (int) $input));

            return (bool) date('L', (int) $date);
        }

        if (is_scalar($input)) {
            return $this->isValid((int) date('Y', (int) strtotime((string) $input)));
        }

        if ($input instanceof DateTimeInterface) {
            return $this->isValid($input->format('Y'));
        }

        return false;
    }
}
