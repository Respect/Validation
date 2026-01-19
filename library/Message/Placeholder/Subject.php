<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Message\Placeholder;

use Respect\Validation\Name;
use Respect\Validation\Path;
use Respect\Validation\Result;

final readonly class Subject
{
    public function __construct(
        public mixed $input,
        public Path|null $path = null,
        public Name|null $name = null,
        public bool $hasPrecedentName = true,
    ) {
    }

    public static function fromResult(Result $result): self
    {
        return new self($result->input, $result->path, $result->name, $result->hasPrecedentName);
    }
}
