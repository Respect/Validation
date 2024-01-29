<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

use Respect\Validation\Rules\KeyNested;

final class KeyNestedException extends NestedValidationException implements NonOmissibleException
{
    /**
     * @var array<string, array<string, string>>
     */
    protected array $defaultTemplates = [
        self::MODE_DEFAULT => [
            KeyNested::TEMPLATE_NOT_PRESENT => 'No items were found for key chain {{name}}',
            KeyNested::TEMPLATE_INVALID => 'Key chain {{name}} is not valid',
        ],
        self::MODE_NEGATIVE => [
            KeyNested::TEMPLATE_NOT_PRESENT => 'Items for key chain {{name}} must not be present',
            KeyNested::TEMPLATE_INVALID => 'Key chain {{name}} must not be valid',
        ],
    ];
}
