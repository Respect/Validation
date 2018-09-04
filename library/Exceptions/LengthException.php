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
 * @author Danilo Correa <dcorrea@autodoc.com.br>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class LengthException extends ValidationException
{
    public const BOTH = 'both';
    public const LOWER = 'lower';
    public const GREATER = 'greater';
    public const EXACT = 'exact';

    /**
     * {@inheritdoc}
     */
    public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::BOTH => '{{name}} must have a length between {{minValue}} and {{maxValue}}',
            self::LOWER => '{{name}} must have a length greater than {{minValue}}',
            self::GREATER => '{{name}} must have a length lower than {{maxValue}}',
            self::EXACT => '{{name}} must have a length of {{maxValue}}',
        ],
        self::MODE_NEGATIVE => [
            self::BOTH => '{{name}} must not have a length between {{minValue}} and {{maxValue}}',
            self::LOWER => '{{name}} must not have a length greater than {{minValue}}',
            self::GREATER => '{{name}} must not have a length lower than {{maxValue}}',
            self::EXACT => '{{name}} must not have a length of {{maxValue}}',
        ],
    ];

    /**
     * {@inheritdoc}
     */
    protected function chooseTemplate(): string
    {
        if (!$this->getParam('minValue')) {
            return static::GREATER;
        }

        if (!$this->getParam('maxValue')) {
            return static::LOWER;
        }

        if ($this->getParam('minValue') == $this->getParam('maxValue')) {
            return self::EXACT;
        }

        return static::BOTH;
    }
}
