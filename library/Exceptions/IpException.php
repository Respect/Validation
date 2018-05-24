<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

class IpException extends ValidationException
{
    public const NETWORK_RANGE = 'network_range';

    public static $defaultTemplates = [
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
        if (!$this->getParam('networkRange')) {
            return static::STANDARD;
        }

        return static::NETWORK_RANGE;
    }
}
