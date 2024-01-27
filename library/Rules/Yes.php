<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use function is_string;
use function nl_langinfo;
use function preg_match;

use const YESEXPR;

final class Yes extends AbstractRule
{
    public function __construct(
        private readonly bool $useLocale = false
    ) {
    }

    public function validate(mixed $input): bool
    {
        if (!is_string($input)) {
            return false;
        }

        return preg_match($this->getPattern(), $input) > 0;
    }

    private function getPattern(): string
    {
        if ($this->useLocale) {
            return '/' . nl_langinfo(YESEXPR) . '/';
        }

        return '/^y(eah?|ep|es)?$/i';
    }
}
