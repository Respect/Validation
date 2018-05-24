<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

/**
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class DateTimeException extends ValidationException
{
    public const FORMAT = 'format';

    /**
     * {@inheritdoc}
     */
    public static $defaultTemplates = [
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
     * {@inheritdoc}
     */
    protected function chooseTemplate(): string
    {
        return $this->getParam('format') ? static::FORMAT : static::STANDARD;
    }
}
