<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Helpers;

use Respect\Validation\Result;
use Respect\Validation\Validatable;

trait CanBindEvaluateRule
{
    private function bindEvaluate(Validatable $binded, Validatable $binder, mixed $input): Result
    {
        if ($binder->getName() !== null && $binded->getName() === null) {
            $binded->setName($binder->getName());
        }

        if ($binder->getTemplate() !== null && $binded->getTemplate() === null) {
            $binded->setTemplate($binder->getTemplate());
        }

        return $binded->evaluate($input);
    }
}
