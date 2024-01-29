<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

use Respect\Validation\Rules\Size;

final class SizeException extends NestedValidationException
{
    /**
     * @var array<string, array<string, string>>
     */
    protected array $defaultTemplates = [
        self::MODE_DEFAULT => [
            Size::TEMPLATE_BOTH => '{{name}} must be between {{minSize}} and {{maxSize}}',
            Size::TEMPLATE_LOWER => '{{name}} must be greater than {{minSize}}',
            Size::TEMPLATE_GREATER => '{{name}} must be lower than {{maxSize}}',
        ],
        self::MODE_NEGATIVE => [
            Size::TEMPLATE_BOTH => '{{name}} must not be between {{minSize}} and {{maxSize}}',
            Size::TEMPLATE_LOWER => '{{name}} must not be greater than {{minSize}}',
            Size::TEMPLATE_GREATER => '{{name}} must not be lower than {{maxSize}}',
        ],
    ];
}
