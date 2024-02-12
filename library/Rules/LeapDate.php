<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use DateTimeImmutable;
use DateTimeInterface;
use Respect\Validation\Message\Template;

use function is_scalar;

#[Template(
    '{{name}} must be leap date',
    '{{name}} must not be leap date',
)]
final class LeapDate extends Simple
{
    public function __construct(
        private readonly string $format
    ) {
    }

    public function validate(mixed $input): bool
    {
        if ($input instanceof DateTimeInterface) {
            return $input->format('m-d') === '02-29';
        }

        if (is_scalar($input)) {
            return $this->validate(DateTimeImmutable::createFromFormat($this->format, (string) $input));
        }

        return false;
    }
}
