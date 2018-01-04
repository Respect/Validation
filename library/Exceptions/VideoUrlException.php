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

class VideoUrlException extends ValidationException
{
    const SERVICE = 1;

    public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => '{{name}} must be a valid video URL',
            self::SERVICE => '{{name}} must be a valid {{service}} video URL',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => '{{name}} must not be a valid video URL',
            self::SERVICE => '{{name}} must not be a valid {{service}} video URL',
        ],
    ];

    /**
     * {@inheritdoc}
     */
    public function chooseTemplate()
    {
        if (false !== $this->getParam('service')) {
            return self::SERVICE;
        }

        return static::STANDARD;
    }
}
