<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use Respect\Validation\Result;
use Respect\Validation\Rule;
use Respect\Validation\Rules\Core\Wrapper;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
final class PropertyOptional extends Wrapper
{
    public function __construct(
        private readonly string $propertyName,
        Rule $rule,
    ) {
        parent::__construct($rule);
    }

    public function evaluate(mixed $input): Result
    {
        $propertyExistsResult = (new PropertyExists($this->propertyName))->evaluate($input);
        if (!$propertyExistsResult->isValid) {
            return $propertyExistsResult->withNameFrom($this->rule)->withToggledModeAndValidation();
        }

        return (new Property($this->propertyName, $this->rule))->evaluate($input);
    }
}
