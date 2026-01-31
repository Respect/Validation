<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\StringFormatter\InvalidFormatterException;
use Respect\StringFormatter\PatternFormatter;
use Respect\Validation\Exceptions\InvalidValidatorException;
use Respect\Validation\Result;
use Respect\Validation\Validator;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
final readonly class Patterned implements Validator
{
    private PatternFormatter $patternFormatter;

    public function __construct(
        private string $pattern,
        private Validator $validator,
    ) {
        try {
            $this->patternFormatter = new PatternFormatter($this->pattern);
        } catch (InvalidFormatterException $exception) {
            throw new InvalidValidatorException($exception->getMessage());
        }
    }

    public function evaluate(mixed $input): Result
    {
        $stringVal = new StringVal();
        $stringValResult = $stringVal->evaluate($input);
        if (!$stringValResult->hasPassed) {
            return $stringValResult->withNameFrom($this->validator)->withIdFrom($this->validator);
        }

        return $this->validator->evaluate($input)->withInput($this->patternFormatter->format((string) $input));
    }
}
