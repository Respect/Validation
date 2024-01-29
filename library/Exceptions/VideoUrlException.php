<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

use Respect\Validation\Rules\VideoUrl;
use Respect\Validation\Validatable;

final class VideoUrlException extends ValidationException
{
    /**
     * @var array<string, array<string, string>>
     */
    protected array $defaultTemplates = [
        self::MODE_DEFAULT => [
            Validatable::TEMPLATE_STANDARD => '{{name}} must be a valid video URL',
            VideoUrl::TEMPLATE_SERVICE => '{{name}} must be a valid {{service}} video URL',
        ],
        self::MODE_NEGATIVE => [
            Validatable::TEMPLATE_STANDARD => '{{name}} must not be a valid video URL',
            VideoUrl::TEMPLATE_SERVICE => '{{name}} must not be a valid {{service}} video URL',
        ],
    ];
}
