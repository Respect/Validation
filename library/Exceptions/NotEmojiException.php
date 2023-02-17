<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
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
            self::STANDARD => '{{name}} must not contain an Emoji',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => '{{name}} must contain an Emoji',
        ],
    ];
}
