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

use function min;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template('The minimum from', 'The minimum from')]
final class Min extends ArrayAggregateFunction
{
    protected string $idPrefix = 'min';

    protected function extractAggregate(array $input): mixed
    {
        return min($input);
    }
}
