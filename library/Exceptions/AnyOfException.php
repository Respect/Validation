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
final class AnyOfException extends NestedValidationException
{
    /**
     * {@inheritDoc}
     */
    public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => 'At least one of these rules must pass for {{name}}',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => 'At least one of these rules must not pass for {{name}}',
        ],
    ];
}
