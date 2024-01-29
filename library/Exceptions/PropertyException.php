<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

use Respect\Validation\Rules\Property;

final class PropertyException extends NestedValidationException implements NonOmissibleException
{
    /**
     * @var array<string, array<string, string>>
     */
    protected array $defaultTemplates = [
        self::MODE_DEFAULT => [
            Property::TEMPLATE_NOT_PRESENT => 'Property {{name}} must be present',
            Property::TEMPLATE_INVALID => 'Property {{name}} must be valid',
        ],
        self::MODE_NEGATIVE => [
            Property::TEMPLATE_NOT_PRESENT => 'Property {{name}} must not be present',
            Property::TEMPLATE_INVALID => 'Property {{name}} must not validate',
        ],
    ];
}
