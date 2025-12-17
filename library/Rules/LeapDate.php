<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use DateTimeImmutable;
use DateTimeInterface;
use Respect\Validation\Message\Template;
use Respect\Validation\Rules\Core\Simple;

use function is_scalar;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{name}} must be a valid leap date',
    '{{name}} must not be a leap date',
)]
final class LeapDate extends Simple
{
    public function __construct(
        private readonly string $format,
    ) {
    }

    public function isValid(mixed $input): bool
    {
        if ($input instanceof DateTimeInterface) {
            return $input->format('m-d') === '02-29';
        }

        if (is_scalar($input)) {
            return $this->isValid(DateTimeImmutable::createFromFormat($this->format, (string) $input));
        }

        return false;
    }
}
