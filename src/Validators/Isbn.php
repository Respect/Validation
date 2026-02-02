<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Moritz <moritzgitfromm@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Validators\Core\Simple;

use function implode;
use function is_scalar;
use function preg_match;
use function sprintf;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be an ISBN',
    '{{subject}} must not be an ISBN',
)]
final class Isbn extends Simple
{
    /** @see https://howtodoinjava.com/regex/java-regex-validate-international-standard-book-number-isbns */
    private const array PIECES = [
        '^(?:ISBN(?:-1[03])?:? )?(?=[0-9X]{10}$|(?=(?:[0-9]+[- ]){3})',
        '[- 0-9X]{13}$|97[89][0-9]{10}$|(?=(?:[0-9]+[- ]){4})[- 0-9]{17}$)',
        '(?:97[89][- ]?)?[0-9]{1,5}[- ]?[0-9]+[- ]?[0-9]+[- ]?[0-9X]$',
    ];

    public function isValid(mixed $input): bool
    {
        if (!is_scalar($input)) {
            return false;
        }

        return preg_match(sprintf('/%s/', implode(self::PIECES)), (string) $input) > 0;
    }
}
