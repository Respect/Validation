<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Emmerson Siqueira <emmersonsiqueira@gmail.com>
 * SPDX-FileContributor: Fabio Ribeiro <faabiosr@gmail.com>
 * SPDX-FileContributor: Graham Campbell <graham@mineuk.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Validation\Path;
use Respect\Validation\Result;
use Respect\Validation\Validator;
use Respect\Validation\Validators\Core\KeyRelated;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
final readonly class Key implements KeyRelated
{
    public function __construct(
        private int|string $key,
        private Validator $validator,
    ) {
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

        return $this->validator->evaluate($input[$this->key])
            ->withPath($keyExistsResult->path ?? new Path($this->key));
    }
}
