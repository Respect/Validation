<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules\Core;

use Respect\Validation\Result;
use Respect\Validation\Rule;

final class Binder extends Standard
{
    public function __construct(
        private readonly Rule $source,
        private readonly Rule $bound,
    ) {
    }

    public function evaluate(mixed $input): Result
    {
        if ($this->source->getName() !== null && $this->bound->getName() === null) {
            $this->bound->setName($this->source->getName());
        }

        if ($this->source->getTemplate() !== null && $this->bound->getTemplate() === null) {
            $this->bound->setTemplate($this->source->getTemplate());
        }

        return $this->bound->evaluate($input);
    }
}
