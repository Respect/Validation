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
use DateTimeInterface;
use Respect\Validation\Helpers\CanValidateDateTime;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Validator;

use function date;
use function is_scalar;
use function strtotime;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be a date/time',
    '{{subject}} must not be a date/time',
    self::TEMPLATE_STANDARD,
)]
#[Template(
    '{{subject}} must be a date/time in the {{sample}} format',
    '{{subject}} must not be a date/time in the {{sample}} format',
    self::TEMPLATE_FORMAT,
)]
final class DateTime implements Validator
{
    use CanValidateDateTime;

    public const string TEMPLATE_FORMAT = '__format__';

    public function __construct(
        private readonly string|null $format = null,
    ) {
    }

    public function evaluate(mixed $input): Result
    {
        $template = $this->format !== null ? self::TEMPLATE_FORMAT : self::TEMPLATE_STANDARD;
        $parameters = ['sample' => date($this->format ?: 'c', strtotime('2005-12-30 01:02:03'))];
        if ($input instanceof DateTimeInterface) {
            return Result::of($this->format === null, $input, $this, $parameters, $template);
        }

        if (!is_scalar($input)) {
            return Result::failed($input, $this, $parameters, $template);
        }

        if ($this->format === null) {
            return Result::of(strtotime((string) $input) !== false, $input, $this, $parameters, $template);
        }

        return Result::of($this->isDateTime($this->format, (string) $input), $input, $this, $parameters, $template);
    }
}
