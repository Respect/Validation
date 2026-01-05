<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Validation\Result;
use Respect\Validation\Validator;
use Respect\Validation\Validators\Core\Wrapper;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
final class Templated extends Wrapper
{
    /** @param array<string, mixed> $parameters */
    public function __construct(
        private readonly string $template,
        Validator $validator,
        private readonly array $parameters = [],
    ) {
        parent::__construct($validator);
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
