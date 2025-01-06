<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\ComponentException;

use function array_diff;
use function in_array;
use function mb_detect_encoding;
use function mb_list_encodings;

/**
 * Validates if a string is in a specific charset.
 *
 * @author Alexandre Gomes Gaigalas <alganet@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author William Espindola <oi@williamespindola.com.br>
 */
final class Charset extends AbstractRule
{
    /**
     * @var string[]
     */
    private $charset;

    /**
     * Initializes the rule.
     *
     * @throws ComponentException
     */
    public function __construct(string ...$charset)
    {
        $available = mb_list_encodings();
        if (!empty(array_diff($charset, $available))) {
            throw new ComponentException('Invalid charset');
        }

        $this->charset = $charset;
    }

    /**
     * @deprecated Calling `validate()` directly from rules is deprecated. Please use {@see \Respect\Validation\Validator::isValid()} instead.
     */
    public function validate($input): bool
    {
        return in_array(mb_detect_encoding($input, $this->charset, true), $this->charset, true);
    }
}
