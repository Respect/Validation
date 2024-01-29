<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

use Respect\Validation\Rules\NotBlank;
use Respect\Validation\Validatable;

final class NotBlankException extends ValidationException
{
    /**
     * @var array<string, array<string, string>>
     */
    protected array $defaultTemplates = [
        self::MODE_DEFAULT => [
            Validatable::TEMPLATE_STANDARD => 'The value must not be blank',
            NotBlank::TEMPLATE_NAMED => '{{name}} must not be blank',
        ],
        self::MODE_NEGATIVE => [
            Validatable::TEMPLATE_STANDARD => 'The value must be blank',
            NotBlank::TEMPLATE_NAMED => '{{name}} must be blank',
        ],
    ];
}
