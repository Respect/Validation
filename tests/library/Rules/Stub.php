<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Rules;

use PHPUnit\Framework\Assert;
use ReflectionClass;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Message\Template;
use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Test\Exceptions\StubException;

use function array_fill;
use function array_shift;

#[Template(
    '{{name}} must be a valid stub',
    '{{name}} must not be a valid stub',
)]
final class Stub extends AbstractRule
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

    public static function fail(int $expectedCount): self
    {
        return new self(...array_fill(0, $expectedCount, false));
    }

    public function validate(mixed $input): bool
    {
        $this->inputs[] = $input;

        if (empty($this->validations)) {
            Assert::fail('Insufficient validations provided for Stub rule');
        }

        return (bool) array_shift($this->validations);
    }

    /** @param array<string, mixed> $extraParameters */
    public function reportError(mixed $input, array $extraParameters = []): ValidationException
    {
        $exception = parent::reportError($input, $extraParameters);

        $reflection = new ReflectionClass($exception);

        return new StubException(
            input: $reflection->getProperty('input')->getValue($exception),
            id:  $exception->getId(),
            params: $exception->getParams(),
            template: $reflection->getProperty('template')->getValue($exception),
            templates: $reflection->getProperty('templates')->getValue($exception),
            formatter: $reflection->getProperty('formatter')->getValue($exception),
        );
    }
}
