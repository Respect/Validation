<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

/**
 * @author Cameron Hall <me@chall.id.au>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class YesException extends ValidationException
{
    /**
     * {@inheritDoc}
     */
    protected $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => '{{name}} is not considered as "Yes"',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => '{{name}} is considered as "Yes"',
        ],
    ];
}
