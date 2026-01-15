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
use Respect\StringFormatter\MaskFormatter;
use Respect\Validation\Exceptions\InvalidValidatorException;
use Respect\Validation\Result;
use Respect\Validation\Validator;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
final readonly class Masked implements Validator
{
    private MaskFormatter $maskFormatter;

    public function __construct(
        private string $range,
        private Validator $validator,
        private string $replacement = '*',
    ) {
        try {
            $this->maskFormatter = new MaskFormatter($this->range, $this->replacement);
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

        return $this->validator->evaluate($input)->withInput($this->maskFormatter->format((string) $input));
    }
}
