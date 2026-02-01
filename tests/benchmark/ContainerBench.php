<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 */

declare(strict_types=1);

namespace Respect\Validation\Benchmarks;

use PhpBench\Attributes as Bench;
use Respect\Validation\ContainerRegistry;
use Respect\Validation\ValidatorBuilder;

class ContainerBench
{
    #[Bench\Iterations(10)]
    #[Bench\RetryThreshold(5)]
    #[Bench\Revs(50)]
    #[Bench\Warmup(1)]
    #[Bench\Subject]
    public function containerBuild(): void
    {
        ContainerRegistry::resetContainer();
        ContainerRegistry::getContainer()->get(ValidatorBuilder::class);
    }
}
