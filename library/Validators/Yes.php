<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Validators\Core\Simple;

use function is_string;
use function nl_langinfo;
use function preg_match;

use const YESEXPR;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be similar to "Yes"',
    '{{subject}} must not be similar to "Yes"',
)]
final class Yes extends Simple
{
    public function __construct(
        private readonly bool $useLocale = false,
    ) {
    }

    public function isValid(mixed $input): bool
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
