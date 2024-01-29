<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

use Respect\Validation\Rules\Key;

final class KeyException extends NestedValidationException implements NonOmissibleException
{
    /**
     * @var array<string, array<string, string>>
     */
    protected array $defaultTemplates = [
        self::MODE_DEFAULT => [
            Key::TEMPLATE_NOT_PRESENT => '{{name}} must be present',
            Key::TEMPLATE_INVALID => '{{name}} must be valid',
        ],
        self::MODE_NEGATIVE => [
            Key::TEMPLATE_NOT_PRESENT => '{{name}} must not be present',
            Key::TEMPLATE_INVALID => '{{name}} must not be valid',
        ],
    ];
}
