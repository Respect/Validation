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
use Respect\Validation\Validators\Core\KeyRelated;
use Respect\Validation\Validators\Core\Wrapper;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
final class KeyOptional extends Wrapper implements KeyRelated
{
    public function __construct(
        private readonly int|string $key,
        Validator $validator,
    ) {
        parent::__construct($validator);
    }

    public function getKey(): int|string
    {
        return $this->key;
    }

    public function evaluate(mixed $input): Result
    {
        $keyExistsResult = (new KeyExists($this->key))->evaluate($input);
        if (!$keyExistsResult->hasPassed) {
            return $keyExistsResult->withNameFrom($this->validator)->withToggledModeAndValidation();
        }

        return (new Key($this->key, $this->validator))->evaluate($input);
    }
}
