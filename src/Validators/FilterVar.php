<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Chris Ramakers <chris.ramakers@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Validation\Exceptions\InvalidValidatorException;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Validator;

use function array_key_exists;
use function filter_var;

use const FILTER_VALIDATE_BOOLEAN;
use const FILTER_VALIDATE_DOMAIN;
use const FILTER_VALIDATE_EMAIL;
use const FILTER_VALIDATE_FLOAT;
use const FILTER_VALIDATE_INT;
use const FILTER_VALIDATE_IP;
use const FILTER_VALIDATE_REGEXP;
use const FILTER_VALIDATE_URL;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be valid',
    '{{subject}} must not be valid',
)]
final readonly class FilterVar implements Validator
{
    private const array ALLOWED_FILTERS = [
        FILTER_VALIDATE_BOOLEAN => 'is_bool',
        FILTER_VALIDATE_DOMAIN => 'is_string',
        FILTER_VALIDATE_EMAIL => 'is_string',
        FILTER_VALIDATE_FLOAT => 'is_float',
        FILTER_VALIDATE_INT => 'is_int',
        FILTER_VALIDATE_IP => 'is_string',
        FILTER_VALIDATE_REGEXP => 'is_string',
        FILTER_VALIDATE_URL => 'is_string',
    ];

    public function __construct(private int $filter, private mixed $options = null)
    {
        if (!array_key_exists($filter, self::ALLOWED_FILTERS)) {
            throw new InvalidValidatorException('Cannot accept the given filter');
        }
    }

    public function evaluate(mixed $input): Result
    {
        return Result::of(
            (self::ALLOWED_FILTERS[$this->filter])(match ($this->options) {
                null => filter_var($input, $this->filter),
                default => filter_var($input, $this->filter, $this->options),
            }),
            $input,
            $this,
        );
    }
}
