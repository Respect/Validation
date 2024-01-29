<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Attributes\Template;

use function nl_langinfo;

use const NOEXPR;

#[Template(
    '{{name}} must be similar to "No"',
    '{{name}} must not be similar to "No"',
)]
final class No extends AbstractEnvelope
{
    public function __construct(bool $useLocale = false)
    {
        $pattern = '^n(o(t|pe)?|ix|ay)?$';
        if ($useLocale) {
            $pattern = nl_langinfo(NOEXPR);
        }

        parent::__construct(new Regex('/' . $pattern . '/i'));
    }
}
