<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

final class Nullable extends AbstractWrapper
{
    public function assert(mixed $input): void
    {
        if ($input === null) {
            return;
        }

        parent::assert($input);
    }

    public function check(mixed $input): void
    {
        if ($input === null) {
            return;
        }

        parent::check($input);
    }

    public function validate(mixed $input): bool
    {
        if ($input === null) {
            return true;
        }

        return parent::validate($input);
    }
}
