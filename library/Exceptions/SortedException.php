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
    public const ASCENDING = 'ascending';
    public const DESCENDING = 'descending';

    /**
     * @var array<string, array<string, string>>
     */
    protected array $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::ASCENDING => '{{name}} must be sorted in ascending order',
            self::DESCENDING => '{{name}} must be sorted in descending order',
        ],
        self::MODE_NEGATIVE => [
            self::ASCENDING => '{{name}} must not be sorted in ascending order',
            self::DESCENDING => '{{name}} must not be sorted in descending order',
        ],
    ];

    protected function chooseTemplate(): string
    {
        return $this->getParam('direction') === Sorted::ASCENDING ? self::ASCENDING : self::DESCENDING;
    }
}
