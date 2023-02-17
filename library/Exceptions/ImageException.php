<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

/**
 * @author Danilo Benevides <danilobenevides01@gmail.com>
 * @author Guilherme Siani <guilherme@siani.com.br>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class ImageException extends ValidationException
{
    /**
     * {@inheritDoc}
     */
    protected $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => '{{name}} must be a valid image',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => '{{name}} must not be a valid image',
        ],
    ];
}
