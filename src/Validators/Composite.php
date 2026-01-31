<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Validator;

use function array_filter;
use function array_map;
use function array_reduce;
use function count;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must pass the rules',
    '{{subject}} must pass the rules',
    self::TEMPLATE_SOME,
)]
#[Template(
    '{{subject}} must pass all the rules',
    '{{subject}} must pass all the rules',
    self::TEMPLATE_ALL,
)]
readonly class Composite implements Validator
{
    public const string TEMPLATE_ALL = '__all__';
    public const string TEMPLATE_SOME = '__some__';

    /** @var array<Validator> */
    protected array $validators;

    public function __construct(Validator ...$validators)
    {
        $this->validators = $validators;
    }

    public function evaluate(mixed $input): Result
    {
        $children = array_map(static fn(Validator $validator) => $validator->evaluate($input), $this->validators);
        $valid = array_reduce($children, static fn(bool $carry, Result $result) => $carry && $result->hasPassed, true);
        $failed = array_filter($children, static fn(Result $result): bool => !$result->hasPassed);
        $template = self::TEMPLATE_SOME;

        if (count($children) === count($failed)) {
            $template = self::TEMPLATE_ALL;
        }

        return Result::of($valid, $input, $this, [], $template)->withChildren(...$children);
    }

    /** @return array<Validator> */
    public function getValidators(): array
    {
        return $this->validators;
    }
}
