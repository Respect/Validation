<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Message\Template;
use Respect\Validation\Rules\Core\Simple;

use function is_string;
use function preg_match;

/**
 * @see http://semver.org/
 */
#[Template(
    '{{name}} must be a version',
    '{{name}} must not be a version',
)]
final class Version extends Simple
{
    protected function isValid(mixed $input): bool
    {
        if (!is_string($input)) {
            return false;
        }

        return preg_match('/^[0-9]+\.[0-9]+\.[0-9]+([+-][^+-][0-9A-Za-z-.]*)?$/', $input) > 0;
    }
}
