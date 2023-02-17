<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

/**
 * @author Bruno Luiz da Silva <contato@brunoluiz.net>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class DateException extends ValidationException
{
    /**
     * {@inheritDoc}
     */
    protected $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => '{{name}} must be a valid date in the format {{sample}}',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => '{{name}} must not be a valid date in the format {{sample}}',
        ],
    ];
}
