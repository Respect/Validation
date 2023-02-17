<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use function nl_langinfo;

use const NOEXPR;

/**
 * Validates if value is considered as "No".
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
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
