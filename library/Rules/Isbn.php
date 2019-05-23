<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use function implode;
use function is_scalar;
use function preg_match;
use function sprintf;

/**
 * Validates whether the input is a valid ISBN (International Standard Book Number) or not.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Moritz Fromm <moritzgitfromm@gmail.com>
 */
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

    /**
     * {@inheritDoc}
     */
    public function validate($input): bool
    {
        if (!is_scalar($input)) {
            return false;
        }

        return preg_match(sprintf('/%s/', implode(self::PIECES)), $input) > 0;
    }
}
