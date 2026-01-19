<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Graham Campbell <graham@mineuk.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 * SPDX-FileContributor: Torben Brodt <t.brodt@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Validation\Exceptions\InvalidValidatorException;
use Respect\Validation\Helpers\CanCompareValues;
use Respect\Validation\Message\Template;
use Respect\Validation\Validators\Core\Envelope;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be between {{minValue}} and {{maxValue}}',
    '{{subject}} must not be between {{minValue}} and {{maxValue}}',
)]
final class Between extends Envelope
{
    use CanCompareValues;

    public function __construct(mixed $minValue, mixed $maxValue)
    {
        if ($this->toComparable($minValue) >= $this->toComparable($maxValue)) {
            throw new InvalidValidatorException('Minimum cannot be less than or equals to maximum');
        }

        parent::__construct(
            new AllOf(
                new GreaterThanOrEqual($minValue),
                new LessThanOrEqual($maxValue),
            ),
            [
                'minValue' => $minValue,
                'maxValue' => $maxValue,
            ],
        );
    }
}
