<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use Respect\Validation\Path;
use Respect\Validation\Result;
use Respect\Validation\Rules\Core\KeyRelated;
use Respect\Validation\Rules\Core\Wrapper;
use Respect\Validation\Validator;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
final class Key extends Wrapper implements KeyRelated
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
            return $keyExistsResult->withNameFrom($this->validator);
        }

        return $this->validator->evaluate($input[$this->key])->withPath($keyExistsResult->path ?? new Path($this->key));
    }
}
