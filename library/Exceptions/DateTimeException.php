<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

/**
 * @author Alexandre Gomes Gaigalas <alganet@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class DateTimeException extends ValidationException
{
    public const FORMAT = 'format';

    /**
     * {@inheritDoc}
     */
    protected $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => '{{name}} must be a valid date/time',
            self::FORMAT => '{{name}} must be a valid date/time in the format {{sample}}',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => '{{name}} must not be a valid date/time',
            self::FORMAT => '{{name}} must not be a valid date/time in the format {{sample}}',
        ],
    ];

    /**
     * {@inheritDoc}
     */
    protected function chooseTemplate(): string
    {
        return $this->getParam('format') ? self::FORMAT : self::STANDARD;
    }
}
