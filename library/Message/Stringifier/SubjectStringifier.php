<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Message\Stringifier;

use Respect\Stringifier\Stringifier;
use Respect\Validation\Message\Placeholder\Subject;

use function sprintf;

final readonly class SubjectStringifier implements Stringifier
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

        if ($raw->path === null || $raw->hasPrecedentName) {
            return $this->stringifier->stringify($raw->name, $depth);
        }

        return sprintf(
            '%s (<- %s)',
            $this->stringifier->stringify($raw->path, $depth),
            $this->stringifier->stringify($raw->name, $depth),
        );
    }
}
