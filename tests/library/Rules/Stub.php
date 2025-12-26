<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Rules;

use PHPUnit\Framework\Assert;
use Respect\Validation\Message\Template;
use Respect\Validation\Rules\Core\Simple;

use function array_fill;
use function array_map;
use function array_shift;
use function rand;

#[Template(
    '{{subject}} must be a valid stub',
    '{{subject}} must not be a valid stub',
)]
final class Stub extends Simple
{
    /** @var array<bool> */
    public array $validations;

    /** @var array<mixed> */
    public array $inputs;

    public function __construct(bool ...$validations)
    {
        $this->validations = $validations;
    }

    public static function daze(): self
    {
        return new self();
    }

    public static function pass(int $expectedCount): self
    {
        return new self(...array_fill(0, $expectedCount, true));
    }

    public static function any(int $expectedCount): self
    {
        return new self(...array_map(static fn() => rand(0, 1) == 1, array_fill(0, $expectedCount, null)));
    }

    public static function fail(int $expectedCount): self
    {
        return new self(...array_fill(0, $expectedCount, false));
    }

    public function isValid(mixed $input): bool
    {
        $this->inputs[] = $input;

        if (empty($this->validations)) {
            Assert::fail('Insufficient validations provided for Stub rule');
        }

        return (bool) array_shift($this->validations);
    }
}
