<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

/**
 * @author Alexandre Gomes Gaigalas <alganet@gmail.com>
 * @author Danilo Benevides <danilobenevides01@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 * @deprecated Using rule exceptions directly is deprecated, and will be removed in the next major version. Please use {@see ValidationException} instead.
 */
final class IpException extends ValidationException
{
    public const NETWORK_RANGE = 'network_range';

    /**
     * {@inheritDoc}
     */
    protected $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => '{{name}} must be an IP address',
            self::NETWORK_RANGE => '{{name}} must be an IP address in the {{range}} range',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => '{{name}} must not be an IP address',
            self::NETWORK_RANGE => '{{name}} must not be an IP address in the {{range}} range',
        ],
    ];

    /**
     * {@inheritDoc}
     */
    protected function chooseTemplate(): string
    {
        if (!$this->getParam('range')) {
            return self::STANDARD;
        }

        return self::NETWORK_RANGE;
    }
}
