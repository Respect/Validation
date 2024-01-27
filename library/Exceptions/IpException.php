<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

final class IpException extends ValidationException
{
    public const NETWORK_RANGE = 'network_range';

    /**
     * @var array<string, array<string, string>>
     */
    protected array $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => '{{name}} must be an IP address',
            self::NETWORK_RANGE => '{{name}} must be an IP address in the {{range}} range',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => '{{name}} must not be an IP address',
            self::NETWORK_RANGE => '{{name}} must not be an IP address in the {{range}} range',
        ],
    ];

    protected function chooseTemplate(): string
    {
        if (!$this->getParam('range')) {
            return self::STANDARD;
        }

        return self::NETWORK_RANGE;
    }
}
