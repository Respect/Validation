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

use function count;

/**
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class KeySetException extends GroupedValidationException implements NonOmissibleException
{
    public const STRUCTURE = 'structure';

    /**
     * {@inheritDoc}
     */
    protected $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::NONE => '所有必需的规则都必须传递给 {{name}}',
            self::SOME => '这些规则必须传递给 {{name}}',
            self::STRUCTURE => '必须有键 {{keys}}',
        ],
        self::MODE_NEGATIVE => [
            self::NONE => '这些规则都不能传递给 {{name}}',
            self::SOME => '这些规则不能传递给 {{name}}',
            self::STRUCTURE => '不能有键 {{keys}}',
        ],
    ];

    /**
     * {@inheritDoc}
     */
    protected function chooseTemplate(): string
    {
        if (count($this->getChildren()) === 0) {
            return self::STRUCTURE;
        }

        return parent::chooseTemplate();
    }
}
