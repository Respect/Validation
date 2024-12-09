<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use Respect\Validation\Exceptions\InvalidRuleConstructorException;
use Respect\Validation\Helpers\CanCompareValues;
use Respect\Validation\Message\Template;
use Respect\Validation\Rules\Core\Envelope;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{name}} must be greater than {{minValue}} and less than {{maxValue}}',
    '{{name}} must not be greater than {{minValue}} or less than {{maxValue}}',
)]
final class BetweenExclusive extends Envelope
{
    use CanCompareValues;

    public function __construct(mixed $minimum, mixed $maximum)
    {
        if ($this->toComparable($minimum) >= $this->toComparable($maximum)) {
            throw new InvalidRuleConstructorException('Minimum cannot be less than or equals to maximum');
        }

        parent::__construct(
            new AllOf(new GreaterThan($minimum), new LessThan($maximum)),
            ['minValue' => $minimum, 'maxValue' => $maximum]
        );
    }
}
