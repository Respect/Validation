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
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class KeyValueException extends ValidationException
{
    public const COMPONENT = 'component';

    /**
     * {@inheritDoc}
     */
    protected $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => '键 {{name}} 必须存在',
            self::COMPONENT => '{{baseKey}} 必须有效才能验证 {{comparedKey}}',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => '键 {{name}} 不能存在',
            self::COMPONENT => '{{baseKey}} 必须无效才能验证 {{comparedKey}}',
        ],
    ];

    protected function chooseTemplate(): string
    {
        return $this->getParam('component') ? self::COMPONENT : self::STANDARD;
    }
}
