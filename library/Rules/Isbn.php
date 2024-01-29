<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Attributes\Template;

use function implode;
use function is_scalar;
use function preg_match;
use function sprintf;

#[Template(
    '{{name}} must be a ISBN',
    '{{name}} must not be a ISBN',
)]
final class Isbn extends AbstractRule
{
    /**
     * @see https://howtodoinjava.com/regex/java-regex-validate-international-standard-book-number-isbns
     */
    private const PIECES = [
        '^(?:ISBN(?:-1[03])?:? )?(?=[0-9X]{10}$|(?=(?:[0-9]+[- ]){3})',
        '[- 0-9X]{13}$|97[89][0-9]{10}$|(?=(?:[0-9]+[- ]){4})[- 0-9]{17}$)',
        '(?:97[89][- ]?)?[0-9]{1,5}[- ]?[0-9]+[- ]?[0-9]+[- ]?[0-9X]$',
    ];

    public function validate(mixed $input): bool
    {
        if (!is_scalar($input)) {
            return false;
        }

        return preg_match(sprintf('/%s/', implode(self::PIECES)), (string) $input) > 0;
    }
}
