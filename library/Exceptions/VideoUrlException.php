<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Exceptions;

class VideoUrlException extends ValidationException
{
    const PROVIDER = 1;

    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must be a valid video URL',
            self::PROVIDER => '{{name}} must be a valid {{provider}} video URL',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not be a valid video URL',
            self::PROVIDER => '{{name}} must not be a valid {{provider}} video URL',
        ),
    );

    /**
     * {@inheritdoc}
     */
    public function chooseTemplate()
    {
        if (false !== $this->getParam('provider')) {
            return self::PROVIDER;
        }

        return static::STANDARD;
    }
}
