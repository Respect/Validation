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

final class Charset extends AbstractRule
{
    /**
     * @var string[]
     */
    private array $charset;

    /**
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

    public function validate(mixed $input): bool
    {
        return in_array(mb_detect_encoding($input, $this->charset, true), $this->charset, true);
    }
}
