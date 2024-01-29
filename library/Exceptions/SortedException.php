<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

use Respect\Validation\Rules\Sorted;

final class SortedException extends ValidationException
{
    /**
     * @var array<string, array<string, string>>
     */
    protected array $defaultTemplates = [
        self::MODE_DEFAULT => [
            Sorted::TEMPLATE_ASCENDING => '{{name}} must be sorted in ascending order',
            Sorted::TEMPLATE_DESCENDING => '{{name}} must be sorted in descending order',
        ],
        self::MODE_NEGATIVE => [
            Sorted::TEMPLATE_ASCENDING => '{{name}} must not be sorted in ascending order',
            Sorted::TEMPLATE_DESCENDING => '{{name}} must not be sorted in descending order',
        ],
    ];
}
