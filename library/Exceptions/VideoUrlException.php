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
    const MULTIPLE = 'multiple';
    const YOUTUBE = 'youtube';
    const VIMEO = 'vimeo';

    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must be a valid video url',
            self::MULTIPLE => '{{name}} must be a valid video url in {{provider}}',
            self::YOUTUBE => '{{name}} must be a valid video url youtube',
            self::VIMEO => '{{name}} must be a valid video url vimeo',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not be a valid video url',
            self::MULTIPLE => '{{name}} must not be a valid video url in {{provider}}',
            self::YOUTUBE => '{{name}} must not be a valid video url youtube',
            self::VIMEO => '{{name}} must not be a valid video url vimeo',
        ),
    );

    /**
     * chooseTemplate
     *
     * @return int|string
     */
    public function chooseTemplate()
    {
        $provider = $this->getParam('provider');

        if(! $provider || !is_array($provider) || count($provider) === 0) {
            return static::STANDARD;
        }

        if(count($provider) > 1) {
            return static::MULTIPLE;
        }

        switch($provider[0]) {
            case static::YOUTUBE: return self::YOUTUBE;
            case static::VIMEO: return static::VIMEO;
            default: return static::STANDARD;
        }
    }

}
