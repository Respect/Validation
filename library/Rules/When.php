<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Result;
use Respect\Validation\Rule;
use Respect\Validation\Rules\Core\Binder;
use Respect\Validation\Rules\Core\Standard;

final class When extends Standard
{
    private readonly Rule $else;

    public function __construct(
        private readonly Rule $when,
        private readonly Rule $then,
        ?Rule $else = null
    ) {
        if ($else === null) {
            $else = new AlwaysInvalid();
            $else->setTemplate(AlwaysInvalid::TEMPLATE_SIMPLE);
        }

        $this->else = $else;
    }

    public function evaluate(mixed $input): Result
    {
        $whenResult = (new Binder($this, $this->when))->evaluate($input);
        if ($whenResult->isValid) {
            return (new Binder($this, $this->then))->evaluate($input);
        }

        return (new Binder($this, $this->else))->evaluate($input);
    }
}
