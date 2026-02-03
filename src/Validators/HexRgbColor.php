<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: davidepastore <pasdavide@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Validators\Core\Envelope;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be a hex RGB color',
    '{{subject}} must not be a hex RGB color',
)]
final class HexRgbColor extends Envelope
{
    public function __construct()
    {
        parent::__construct(new Regex('/^#?([0-9A-F]{3}|[0-9A-F]{6})$/i'));
    }
}
