<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

use Respect\Validation\Rules\NotEmpty;
use Respect\Validation\Validatable;

final class NotEmptyException extends ValidationException
{
    /**
     * @var array<string, array<string, string>>
     */
    protected array $defaultTemplates = [
        self::MODE_DEFAULT => [
            Validatable::TEMPLATE_STANDARD => 'The value must not be empty',
            NotEmpty::TEMPLATE_NAMED => '{{name}} must not be empty',
        ],
        self::MODE_NEGATIVE => [
            Validatable::TEMPLATE_STANDARD => 'The value must be empty',
            NotEmpty::TEMPLATE_NAMED => '{{name}} must be empty',
        ],
    ];
}
