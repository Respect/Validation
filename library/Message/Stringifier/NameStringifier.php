<?php

declare(strict_types=1);

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

namespace Respect\Validation\Message\Stringifier;

use Respect\Stringifier\Stringifier;
use Respect\Validation\Subject;

use function sprintf;

final readonly class NameStringifier implements Stringifier
{
    public function __construct(
        private Stringifier $stringifier,
    ) {
    }

    public function stringify(mixed $raw, int $depth): string|null
    {
        if (!$raw instanceof Subject) {
            return null;
        }

        if ($raw->path === null && $raw->name === null) {
            return $this->stringifier->stringify($raw->input, $depth);
        }

        if ($raw->name === null) {
            return $this->stringifier->stringify($raw->path, $depth);
        }

        if ($raw->path === null || $raw->isNamePrin === true) {
            return $raw->name->value;
        }

        return sprintf(
            '%s (<- %s)',
            $this->stringifier->stringify($raw->path, $depth),
            $raw->name->value,
        );
    }
}
