<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

/**
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Ricardo Gobbo <ricardo@clicknow.com.br>
 * @deprecated Using rule exceptions directly is deprecated, and will be removed in the next major version. Please use {@see ValidationException} instead.
 */
final class VideoUrlException extends ValidationException
{
    public const SERVICE = 'service';

    /**
     * {@inheritDoc}
     */
    protected $defaultTemplates = [
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
     * {@inheritDoc}
     */
    protected function chooseTemplate(): string
    {
        if ($this->getParam('service')) {
            return self::SERVICE;
        }

        return self::STANDARD;
    }
}
