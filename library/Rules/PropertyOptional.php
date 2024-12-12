<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Helpers\CanExtractPropertyValue;
use Respect\Validation\Result;
use Respect\Validation\Rule;
use Respect\Validation\Rules\Core\Binder;
use Respect\Validation\Rules\Core\Wrapper;

final class PropertyOptional extends Wrapper
{
    use CanExtractPropertyValue;

    public function __construct(
        private readonly string $propertyName,
        Rule $rule,
    ) {
        $rule->setName($rule->getName() ?? $propertyName);
        parent::__construct($rule);
    }

    public function evaluate(mixed $input): Result
    {
        $propertyExistsResult = (new Binder($this, new PropertyExists($this->propertyName)))->evaluate($input);
        if (!$propertyExistsResult->isValid) {
            return $propertyExistsResult->withInvertedMode();
        }

        $childResult = $this->rule
            ->evaluate($this->extractPropertyValue($input, $this->propertyName))
            ->withId($this->propertyName);

        return (new Result($childResult->isValid, $input, $this))
            ->withChildren($childResult)
            ->withId($this->propertyName)
            ->withNameIfMissing($this->rule->getName() ?? $this->propertyName);
    }
}
