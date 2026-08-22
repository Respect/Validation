<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Eduardo Reveles <me@osiux.ws>
 * SPDX-FileContributor: Emmerson Siqueira <emmersonsiqueira@gmail.com>
 * SPDX-FileContributor: Graham Campbell <graham@mineuk.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 * SPDX-FileContributor: qrazi <qrazi.sivlingworkz@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Lcobucci\Clock\SystemClock;
use Psr\Clock\ClockInterface;
use Respect\Validation\Exceptions\InvalidValidatorException;
use Respect\Validation\Helpers\CanValidateDateTime;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Validator;

use function date;
use function is_scalar;
use function preg_match;
use function strtotime;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be a time in the {{sample}} format',
    '{{subject}} must not be a time in the {{sample}} format',
)]
final readonly class Time implements Validator
{
    use CanValidateDateTime;

    private readonly ClockInterface $clock;

    public function __construct(
        private string $format = 'H:i:s',
        ClockInterface|null $clock = null,
    ) {
        if (!preg_match('/^[gGhHisuvaA\W]+$/', $format)) {
            throw new InvalidValidatorException('"%s" is not a valid date format', $format);
        }

        $this->clock = $clock ?? SystemClock::fromSystemTimezone();
    }

    public function evaluate(mixed $input): Result
    {
        $sample = strtotime('23:59:59', $this->clock->now()->getTimestamp());
        $parameters = ['sample' => date($this->format, (int) $sample)];
        if (!is_scalar($input)) {
            return Result::failed($input, $this, $parameters);
        }

        return Result::of($this->isDateTime($this->format, (string) $input), $input, $this, $parameters);
    }
}
