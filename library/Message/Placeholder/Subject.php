<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
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
