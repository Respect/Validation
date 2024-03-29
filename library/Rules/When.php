<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Helpers\CanBindEvaluateRule;
use Respect\Validation\Result;
use Respect\Validation\Rules\Core\Standard;
use Respect\Validation\Validatable;

final class When extends Standard
{
    use CanBindEvaluateRule;

    private readonly Validatable $else;

    public function __construct(
        private readonly Validatable $when,
        private readonly Validatable $then,
        ?Validatable $else = null
    ) {
        if ($else === null) {
            $else = new AlwaysInvalid();
            $else->setTemplate(AlwaysInvalid::TEMPLATE_SIMPLE);
        }

        $this->else = $else;
    }

    public function evaluate(mixed $input): Result
    {
        $whenResult = $this->bindEvaluate($this->when, $this, $input);
        if ($whenResult->isValid) {
            return $this->bindEvaluate($this->then, $this, $input);
        }

        return $this->bindEvaluate($this->else, $this, $input);
    }
}
