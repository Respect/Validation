<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use Respect\Validation\Result;
use Respect\Validation\Rules\Core\Wrapper;
use Respect\Validation\Validator;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
final class PropertyOptional extends Wrapper
{
    public function __construct(
        private readonly string $propertyName,
        Validator $validator,
    ) {
        parent::__construct($validator);
    }

    public function evaluate(mixed $input): Result
    {
        $propertyExistsResult = (new PropertyExists($this->propertyName))->evaluate($input);
        if (!$propertyExistsResult->hasPassed) {
            return $propertyExistsResult->withNameFrom($this->validator)->withToggledModeAndValidation();
        }

        return (new Property($this->propertyName, $this->validator))->evaluate($input);
    }
}
