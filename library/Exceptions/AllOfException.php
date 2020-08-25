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
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
class AllOfException extends GroupedValidationException
{
    /**
     * {@inheritDoc}
     */
    protected $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::NONE => '{{name}} 必需符合以下规则',
            self::SOME => '{{name}} 必需符合以下规则',
        ],
        self::MODE_NEGATIVE => [
            self::NONE => '{{name}} 不能符合以下规则',
            self::SOME => '{{name}} 不能符合以下规则',
        ],
    ];
}
