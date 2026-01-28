<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 */

declare(strict_types=1);

namespace Respect\Validation\Benchmarks;

use Generator;
use PhpBench\Attributes as Bench;
use Respect\Validation\Validator;
use Respect\Validation\ValidatorBuilder;
use Respect\Validation\Validators\Alnum;
use Respect\Validation\Validators\Alpha;
use Respect\Validation\Validators\BoolType;
use Respect\Validation\Validators\Digit;
use Respect\Validation\Validators\Even;
use Respect\Validation\Validators\FloatType;
use Respect\Validation\Validators\IntType;
use Respect\Validation\Validators\Negative;
use Respect\Validation\Validators\Positive;
use Respect\Validation\Validators\StringType;

final class CompositeValidatorsBench
{
    /** @param array{string, array<Validator>} $params */
    #[Bench\ParamProviders(['provideValidatorBuilder'])]
    #[Bench\Iterations(5)]
    #[Bench\Revs(50)]
    #[Bench\Warmup(1)]
    #[Bench\Subject]
    public function isValid(array $params): void
    {
        ValidatorBuilder::__callStatic(...$params)->isValid(42);
    }

    public function provideValidatorBuilder(): Generator
    {
        yield 'allOf(10)' => ['allOf', $this->buildValidators(10)];
        yield 'oneOf(10)' => ['oneOf', $this->buildValidators(10)];
        yield 'anyOf(10)' => ['anyOf', $this->buildValidators(10)];
        yield 'noneOf(10)' => ['noneOf', $this->buildValidators(10)];
        yield 'allOf(100)' => ['allOf', $this->buildValidators(100)];
        yield 'oneOf(100)' => ['oneOf', $this->buildValidators(100)];
        yield 'anyOf(100)' => ['anyOf', $this->buildValidators(100)];
        yield 'noneOf(100)' => ['noneOf', $this->buildValidators(100)];
    }

    /** @return array<Validator> */
    private function buildValidators(int $count): array
    {
        $validators = [];
        for ($i = 0; $i < $count; $i++) {
            $validators[] = $this->makeValidator($i);
        }

        return $validators;
    }

    private function makeValidator(int $index): Validator
    {
        return match ($index % 10) {
            0 => new IntType(),
            1 => new Positive(),
            2 => new Negative(),
            3 => new Even(),
            4 => new FloatType(),
            5 => new StringType(),
            6 => new Alpha(),
            7 => new Alnum(),
            8 => new Digit(),
            default => new BoolType(),
        };
    }
}
