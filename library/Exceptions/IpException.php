<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

use Respect\Validation\Rules\Ip;
use Respect\Validation\Validatable;

final class IpException extends ValidationException
{
    /**
     * @var array<string, array<string, string>>
     */
    protected array $defaultTemplates = [
        self::MODE_DEFAULT => [
            Validatable::TEMPLATE_STANDARD => '{{name}} must be an IP address',
            Ip::TEMPLATE_NETWORK_RANGE => '{{name}} must be an IP address in the {{range}} range',
        ],
        self::MODE_NEGATIVE => [
            Validatable::TEMPLATE_STANDARD => '{{name}} must not be an IP address',
            Ip::TEMPLATE_NETWORK_RANGE => '{{name}} must not be an IP address in the {{range}} range',
        ],
    ];
}
