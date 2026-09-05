<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Validators;

use DateTimeImmutable;
use Lcobucci\Clock\SystemClock;
use Psr\Clock\ClockInterface;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Validator;

#[Template(
    '{{subject}} must be a clock probe',
    '{{subject}} must not be a clock probe',
)]
final class ClockProbe implements Validator
{
    public ClockInterface $clock;

    /** @var array<DateTimeImmutable> */
    public array $instants = [];

    public function __construct(ClockInterface|null $clock = null)
    {
        $this->clock = $clock ?? SystemClock::fromSystemTimezone();
    }

    public function evaluate(mixed $input): Result
    {
        $this->instants[] = $this->clock->now();

        return Result::passed($input, $this);
    }
}
