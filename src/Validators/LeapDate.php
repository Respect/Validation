<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Danilo Benevides <danilobenevides01@gmail.com>
 * SPDX-FileContributor: Graham Campbell <graham@mineuk.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Jayson Reis <santosdosreis@gmail.com>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use DateTimeInterface;
use Lcobucci\Clock\SystemClock;
use Psr\Clock\ClockInterface;
use Respect\Validation\Helpers\CanResolveDateTime;
use Respect\Validation\Message\Template;
use Respect\Validation\Validators\Core\Simple;

use function is_scalar;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be a leap date',
    '{{subject}} must not be a leap date',
)]
final class LeapDate extends Simple
{
    use CanResolveDateTime;

    private readonly ClockInterface $clock;

    public function __construct(
        private readonly string $format,
        ClockInterface|null $clock = null,
    ) {
        $this->clock = $clock ?? SystemClock::fromSystemTimezone();
    }

    public function isValid(mixed $input): bool
    {
        if ($input instanceof DateTimeInterface) {
            return $input->format('m-d') === '02-29';
        }

        if (is_scalar($input)) {
            return $this->isValid($this->resolveDateTimeFromFormat($this->format, (string) $input, $this->clock));
        }

        return false;
    }
}
