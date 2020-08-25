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
            self::NONE => '所有必需的规则都必须传递给 {{name}}',
            self::SOME => '这些规则必须传递给 {{name}}',
        ],
        self::MODE_NEGATIVE => [
            self::NONE => '这些规则都不能传递给 {{name}}',
            self::SOME => '这些规则不能传递给 {{name}}',
        ],
    ];
}
