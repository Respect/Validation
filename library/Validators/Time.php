<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Eduardo Reveles <me@osiux.ws>
 * SPDX-FileContributor: Emmerson <emmersonsiqueira@gmail.com>
 * SPDX-FileContributor: Graham Campbell <graham@mineuk.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 * SPDX-FileContributor: qrazi <qrazi.sivlingworkz@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
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
    '{{subject}} must be a valid time in the format {{sample}}',
    '{{subject}} must not be a valid time in the format {{sample}}',
)]
final readonly class Time implements Validator
{
    use CanValidateDateTime;

    public function __construct(
        private string $format = 'H:i:s',
    ) {
        if (!preg_match('/^[gGhHisuvaA\W]+$/', $format)) {
            throw new InvalidValidatorException('"%s" is not a valid date format', $format);
        }
    }

    public function evaluate(mixed $input): Result
    {
        $parameters = ['sample' => date($this->format, strtotime('23:59:59'))];
        if (!is_scalar($input)) {
            return Result::failed($input, $this, $parameters);
        }

        return Result::of($this->isDateTime($this->format, (string) $input), $input, $this, $parameters);
    }
}
