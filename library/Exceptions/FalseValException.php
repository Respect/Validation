<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

/**
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class FalseValException extends ValidationException
{
    /**
     * {@inheritDoc}
     */
    protected $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => '{{name}} is not considered as "False"',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => '{{name}} is considered as "False"',
        ],
    ];
}
