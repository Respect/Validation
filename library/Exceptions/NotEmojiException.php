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
 * @author Mazen Touati <mazen_touati@hotmail.com>
 */
final class NotEmojiException extends ValidationException
{
    /**
     * {@inheritDoc}
     */
    protected $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => '{{name}} 不能包含表情符号',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => '{{name}} 必须包含表情符号',
        ],
    ];
}
