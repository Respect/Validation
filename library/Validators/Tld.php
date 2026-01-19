<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Validators\Core\Simple;

use function dirname;
use function in_array;
use function is_scalar;
use function mb_strtoupper;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be a valid top-level domain name',
    '{{subject}} must not be a valid top-level domain name',
)]
final class Tld extends Simple
{
    public function isValid(mixed $input): bool
    {
        if (!is_scalar($input)) {
            return false;
        }

        return in_array(mb_strtoupper((string) $input), $this->getTldList());
    }

    /** @return array<string> */
    private function getTldList(): array
    {
        static $tldList = null;

        return $tldList ??= require dirname(__DIR__, 2) . '/data/domain/tld.php';
    }
}
