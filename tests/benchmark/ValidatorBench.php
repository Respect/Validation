<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Benchmarks;

use PhpBench\Attributes as Bench;
use Respect\Validation\Test\SmokeTestProvider;
use Respect\Validation\Validator;

class ValidatorBench
{
    use SmokeTestProvider;

    /** @param array<Validator, mixed> $params */
    #[Bench\Iterations(10)]
    #[Bench\RetryThreshold(10)]
    #[Bench\Revs(5)]
    #[Bench\ParamProviders(['provideValidatorInput'])]
    public function benchValidate(array $params): void
    {
        [$v, $input] = $params;
        $v->validate($input);
    }
}
