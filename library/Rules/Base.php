<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\ComponentException;

use function is_null;
use function mb_strlen;
use function mb_substr;
use function preg_match;
use function sprintf;

final class Base extends AbstractRule
{
    private string $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    public function __construct(private int $base, ?string $chars = null)
    {
        if (!is_null($chars)) {
            $this->chars = $chars;
        }

        $max = mb_strlen($this->chars);
        if ($base > $max) {
            throw new ComponentException(sprintf('a base between 1 and %s is required', $max));
        }
    }

    public function validate(mixed $input): bool
    {
        $valid = mb_substr($this->chars, 0, $this->base);

        return (bool) preg_match('@^[' . $valid . ']+$@', (string) $input);
    }
}
