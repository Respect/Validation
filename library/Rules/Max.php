<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Rules\Core\ArrayAggregateFunction;

use function max;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template('The maximum of', 'The maximum of')]
final class Max extends ArrayAggregateFunction
{
    protected string $idPrefix = 'max';

    protected function extractAggregate(array $input): mixed
    {
        return max($input);
    }
}
