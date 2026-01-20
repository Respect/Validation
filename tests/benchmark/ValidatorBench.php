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
    #[Bench\ParamProviders(['provideValidatorInput'])]
    #[Bench\BeforeMethods('setFileUploadMock')]
    #[Bench\Iterations(10)]
    #[Bench\RetryThreshold(5)]
    #[Bench\Revs(5)]
    #[Bench\Warmup(1)]
    #[Bench\Assert('mode(variant.time.avg) < mode(baseline.time.avg) +/- 10%')]
    #[Bench\Assert('mode(variant.time.net) < mode(baseline.time.net) +/- 10%')]
    #[Bench\Assert('mode(variant.mem.peak) < mode(baseline.mem.peak) +/- 10%')]
    #[Bench\Assert('mode(variant.mem.real) < mode(baseline.mem.real) +/- 10%')]
    #[Bench\Assert('mode(variant.mem.final) < mode(baseline.mem.final) +/- 10%')]
    #[Bench\Subject]
    public function evaluate(array $params): void
    {
        [$v, $input] = $params;
        $v->evaluate($input);
    }

    public function setFileUploadMock(): void
    {
        set_mock_is_uploaded_file_return(true);
    }
}
