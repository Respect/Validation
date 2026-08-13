<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Stubs;

use Attribute;
use Respect\Validation\Validators\Attributes;
use Respect\Validation\Validators\Core\Envelope;

#[Attribute(Attribute::TARGET_PROPERTY)]
final class EnvelopeAttributes extends Envelope
{
    public function __construct()
    {
        parent::__construct(new Attributes());
    }
}
