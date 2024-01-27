<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

final class UuidException extends ValidationException
{
    public const VERSION = 'version';

    /**
     * @var array<string, array<string, string>>
     */
    protected array $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => '{{name}} must be a valid UUID',
            self::VERSION => '{{name}} must be a valid UUID version {{version}}',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => '{{name}} must not be a valid UUID',
            self::VERSION => '{{name}} must not be a valid UUID version {{version}}',
        ],
    ];

    protected function chooseTemplate(): string
    {
        if ($this->getParam('version')) {
            return self::VERSION;
        }

        return self::STANDARD;
    }
}
