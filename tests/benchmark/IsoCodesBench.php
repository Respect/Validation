<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Benchmarks;

use PhpBench\Attributes as Bench;
use Respect\Validation\Test\SmokeTestProvider;
use Respect\Validation\ValidatorBuilder;

class IsoCodesBench
{
    use SmokeTestProvider;

    #[Bench\Iterations(10)]
    #[Bench\RetryThreshold(5)]
    #[Bench\Revs(5)]
    #[Bench\Warmup(1)]
    #[Bench\Subject]
    public function subdivisionCode(): void
    {
        ValidatorBuilder::subdivisionCode('US')->evaluate('CA');
    }

    #[Bench\Iterations(10)]
    #[Bench\RetryThreshold(5)]
    #[Bench\Revs(5)]
    #[Bench\Warmup(1)]
    #[Bench\Subject]
    public function countryCode(): void
    {
        ValidatorBuilder::countryCode()->evaluate('US');
    }

    #[Bench\Iterations(10)]
    #[Bench\RetryThreshold(5)]
    #[Bench\Revs(5)]
    #[Bench\Warmup(1)]
    #[Bench\Subject]
    public function currencyCode(): void
    {
        ValidatorBuilder::currencyCode()->evaluate('USD');
    }

    #[Bench\Iterations(10)]
    #[Bench\RetryThreshold(5)]
    #[Bench\Revs(5)]
    #[Bench\Warmup(1)]
    #[Bench\Subject]
    public function languageCode(): void
    {
        ValidatorBuilder::languageCode()->evaluate('en');
    }

    #[Bench\Iterations(10)]
    #[Bench\RetryThreshold(5)]
    #[Bench\Revs(5)]
    #[Bench\Warmup(1)]
    #[Bench\Subject]
    public function phone(): void
    {
        ValidatorBuilder::phone('US')->evaluate('+1 202-555-0125');
    }
}
