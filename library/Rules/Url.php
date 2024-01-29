<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Attributes\Template;

use const FILTER_VALIDATE_URL;

#[Template(
    '{{name}} must be a URL',
    '{{name}} must not be a URL',
)]
final class Url extends AbstractEnvelope
{
    public function __construct()
    {
        parent::__construct(new FilterVar(FILTER_VALIDATE_URL));
    }
}
