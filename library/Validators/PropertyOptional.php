<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Fabio Ribeiro <faabiosr@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Validation\Result;
use Respect\Validation\Validator;
use Respect\Validation\Validators\Core\Wrapper;

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
