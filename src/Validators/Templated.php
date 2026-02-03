<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Validation\Result;
use Respect\Validation\Validator;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
final readonly class Templated implements Validator
{
    /** @param array<string, mixed> $parameters */
    public function __construct(
        private string $template,
        private Validator $validator,
        private array $parameters = [],
    ) {
    }

    public function evaluate(mixed $input): Result
    {
        $result = $this->validator->evaluate($input);
        if ($result->hasCustomTemplate()) {
            return $result;
        }

        return $result->withTemplate($this->template)->withExtraParameters($this->parameters);
    }
}
