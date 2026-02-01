<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Benchmarks;

use PhpBench\Attributes as Bench;
use Respect\Validation\Transformers\Prefix;
use Respect\Validation\Transformers\ValidatorSpec;

final class PrefixBench
{
    /** @param array{0: Prefix, 1: ValidatorSpec} $params */
    #[Bench\ParamProviders(['provideTransformerSpec'])]
    #[Bench\Iterations(10)]
    #[Bench\RetryThreshold(5)]
    #[Bench\Revs(100)]
    #[Bench\Warmup(1)]
    #[Bench\Subject]
    public function prefixTransformer(array $params): void
    {
        $params[0]->transform($params[1]);
    }

    /** @return array<array{0: Prefix, 1: ValidatorSpec}> */
    public static function provideTransformerSpec(): array
    {
        return [
            [new Prefix(), new ValidatorSpec('keyName', ['value', 'other'])],
            [new Prefix(), new ValidatorSpec('propertyTitle', ['value', 'other'])],
            [new Prefix(), new ValidatorSpec('notSomething', ['value'])],
            [new Prefix(), new ValidatorSpec('not')],
            [new Prefix(), new ValidatorSpec('arrayVal')],
        ];
    }
}
