<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Rules\Core\Envelope;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{name}} must be a hex RGB color',
    '{{name}} must not be a hex RGB color',
)]
final class HexRgbColor extends Envelope
{
    public function __construct()
    {
        parent::__construct(new Regex('/^#?([0-9A-F]{3}|[0-9A-F]{6})$/i'));
    }
}
