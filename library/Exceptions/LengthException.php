<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

/**
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Mazen Touati <mazen_touati@hotmail.com>
 */
final class LengthException extends ValidationException
{
    public const BOTH = 'both';
    public const LOWER = 'lower';
    public const LOWER_INCLUSIVE = 'lower_inclusive';
    public const GREATER = 'greater';
    public const GREATER_INCLUSIVE = 'greater_inclusive';
    public const EXACT = 'exact';

    /**
     * {@inheritDoc}
     */
    protected $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::BOTH => '{{name}} 长度必须在 {{minValue}} 与 {{maxValue}} 之间',
            self::LOWER => '{{name}} 长度必须大于 {{minValue}}',
            self::LOWER_INCLUSIVE => '{{name}} 的长度必须大于或等于 {{minValue}}',
            self::GREATER => '{{name}} 长度必须小于 {{maxValue}}',
            self::GREATER_INCLUSIVE => '{{name}} 长度必须小于或等于 {{maxValue}}',
            self::EXACT => '{{name}} 长度必须是 {{maxValue}}',
        ],
        self::MODE_NEGATIVE => [
            self::BOTH => '{{name}} 的长度不能介于 {{minValue}} 和 {{maxValue}} 之间',
            self::LOWER => '{{name}} 长度不能大于 {{minValue}}',
            self::LOWER_INCLUSIVE => '{{name}} 长度不能大于或等于 {{minValue}}',
            self::GREATER => '{{name}} 长度不得小于 {{maxValue}}',
            self::GREATER_INCLUSIVE => '{{name}} 长度不能小于或等于 {{maxValue}}',
            self::EXACT => '{{name}} 长度不能是 {{maxValue}}',
        ],
    ];

    /**
     * {@inheritDoc}
     */
    protected function chooseTemplate(): string
    {
        $isInclusive = $this->getParam('inclusive');

        if (!$this->getParam('minValue')) {
            return $isInclusive === true ? self::GREATER_INCLUSIVE : self::GREATER;
        }

        if (!$this->getParam('maxValue')) {
            return $isInclusive === true ? self::LOWER_INCLUSIVE : self::LOWER;
        }

        if ($this->getParam('minValue') == $this->getParam('maxValue')) {
            return self::EXACT;
        }

        return self::BOTH;
    }
}
