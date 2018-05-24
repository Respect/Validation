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
 * Exception class for Size rule.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
class SizeException extends NestedValidationException
{
    public const BOTH = 'both';
    public const LOWER = 'lower';
    public const GREATER = 'greater';

    /**
     * {@inheritdoc}
     */
    public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::BOTH => '{{name}} must be between {{minSize}} and {{maxSize}}',
            self::LOWER => '{{name}} must be greater than {{minSize}}',
            self::GREATER => '{{name}} must be lower than {{maxSize}}',
        ],
        self::MODE_NEGATIVE => [
            self::BOTH => '{{name}} must not be between {{minSize}} and {{maxSize}}',
            self::LOWER => '{{name}} must not be greater than {{minSize}}',
            self::GREATER => '{{name}} must not be lower than {{maxSize}}',
        ],
    ];

    /**
     * {@inheritdoc}
     */
    protected function chooseTemplate(): string
    {
        if (!$this->getParam('minValue')) {
            return static::GREATER;
        } elseif (!$this->getParam('maxValue')) {
            return static::LOWER;
        }

        return static::BOTH;
    }
}
