<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Rules;

use Respect\Validation\Rules\AbstractRule;

use function array_shift;

/**
 * @since 2.0.0
 */
final class Stub extends AbstractRule
{
    /**
     * @var bool[]
     */
    public array $validations;

    /**
     * @var mixed[]
     */
    public array $inputs;

    /**
     * @param bool[] ...$validations
     */
    public function __construct(bool ...$validations)
    {
        $this->validations = $validations;
    }

    public function validate(mixed $input): bool
    {
        $this->inputs[] = $input;

        return (bool) array_shift($this->validations);
    }
}
