<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

final class VideoUrlException extends ValidationException
{
    public const SERVICE = 'service';

    /**
     * @var array<string, array<string, string>>
     */
    protected array $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => '{{name}} must be a valid video URL',
            self::SERVICE => '{{name}} must be a valid {{service}} video URL',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => '{{name}} must not be a valid video URL',
            self::SERVICE => '{{name}} must not be a valid {{service}} video URL',
        ],
    ];

    protected function chooseTemplate(): string
    {
        if ($this->getParam('service')) {
            return self::SERVICE;
        }

        return self::STANDARD;
    }
}
