<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
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

use function count;
use function range;

final class CompositeValidatorsBench
{
    /** @param array{string, array<Validator>} $params */
    #[Bench\ParamProviders(['provideGroupedValidatorBuilder'])]
    #[Bench\Iterations(5)]
    #[Bench\Revs(50)]
    #[Bench\Warmup(1)]
    #[Bench\Subject]
    public function isValidGrouped(array $params): void
    {
        ValidatorBuilder::__callStatic(...$params)->isValid(42);
    }

    /** @param array{string, array<Validator>} $params */
    #[Bench\ParamProviders(['provideArrayBasedValidatorBuilder'])]
    #[Bench\Iterations(5)]
    #[Bench\Revs(50)]
    #[Bench\Warmup(1)]
    #[Bench\Subject]
    public function isValidArrayBased(array $params): void
    {
        [$validator, $validators] = $params;
        ValidatorBuilder::__callStatic($validator, $validators)->isValid(range(1, count($validators)));
    }

    #[Bench\ParamProviders(['provideInvalidDomain'])]
    #[Bench\Iterations(5)]
    #[Bench\Revs(50)]
    #[Bench\Warmup(1)]
    #[Bench\Subject]
    public function isValidDomain(mixed $input): void
    {
        ValidatorBuilder::domain()->isValid($input);
    }

    public function provideGroupedValidatorBuilder(): Generator
    {
        yield 'allOf(10)' => ['allOf', $this->buildValidators(10)];
        yield 'oneOf(10)' => ['oneOf', $this->buildValidators(10)];
        yield 'anyOf(10)' => ['anyOf', $this->buildValidators(10)];
        yield 'noneOf(10)' => ['noneOf', $this->buildValidators(10)];
        yield 'shortCircuit(10)' => ['shortCircuit', $this->buildValidators(10)];
        yield 'allOf(100)' => ['allOf', $this->buildValidators(100)];
        yield 'oneOf(100)' => ['oneOf', $this->buildValidators(100)];
        yield 'anyOf(100)' => ['anyOf', $this->buildValidators(100)];
        yield 'noneOf(100)' => ['noneOf', $this->buildValidators(100)];
        yield 'shortCircuit(100)' => ['shortCircuit', $this->buildValidators(100)];
    }

    public function provideArrayBasedValidatorBuilder(): Generator
    {
        yield 'all(10)' => ['all', $this->buildValidators(10)];
        yield 'each(10)' => ['each', $this->buildValidators(10)];
        yield 'all(100)' => ['all', $this->buildValidators(100)];
        yield 'each(100)' => ['each', $this->buildValidators(100)];
    }

    public function provideInvalidDomain(): Generator
    {
        yield 'no dots' => ['no dots'];
        yield 'starts with "-"' => ['-example-invalid.com'];
        yield 'ends with "-"' => ['example.invalid-.com'];
        yield 'double "--"' => ['xn--bcher--kva.ch'];
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
