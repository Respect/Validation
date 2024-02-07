<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Helpers\CanBindEvaluateRule;
use Respect\Validation\Message\Template;
use Respect\Validation\Mode;
use Respect\Validation\Result;
use Respect\Validation\Validatable;

#[Template(
    'after asserting that',
    'after failing to assert that',
)]
final class When extends AbstractRule
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
            $thenResult = $this->bindEvaluate($this->then, $this, $input);
            $thisResult = new Result($thenResult->isValid, $input, $this);

            return $thenResult->withNextSibling($thisResult->withNextSibling($whenResult));
        }

        $elseResult = $this->bindEvaluate($this->else, $this, $input);
        $thisResult = (new Result($elseResult->isValid, $input, $this))->withMode(Mode::NEGATIVE);

        return $elseResult->withNextSibling($thisResult->withNextSibling($whenResult));
    }

    public function validate(mixed $input): bool
    {
        if ($this->when->validate($input)) {
            return $this->then->validate($input);
        }

        return $this->else->validate($input);
    }

    public function assert(mixed $input): void
    {
        if ($this->when->validate($input)) {
            $this->then->assert($input);

            return;
        }

        $this->else->assert($input);
    }

    public function check(mixed $input): void
    {
        if ($this->when->validate($input)) {
            $this->then->check($input);

            return;
        }

        $this->else->check($input);
    }
}
