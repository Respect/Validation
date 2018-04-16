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
 * @author Jens Segers <segers.jens@gmail.com>
 */
final class NullableException extends ValidationException
{
    public const STANDARD = 0;
    public const NAMED = 1;

    /**
     * {@inheritdoc}
     */
    public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => 'The value must be nullable',
            self::NAMED => '{{name}} must be nullable',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => 'The value must not be null',
            self::NAMED => '{{name}} must not be null',
        ],
    ];

    /**
     * {@inheritdoc}
     */
    public function chooseTemplate()
    {
        return $this->hasName() ? static::NAMED : static::STANDARD;
    }
}
