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
 * Stub to help testing rules.
 *
 * @since 2.0.0
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class Stub extends AbstractRule
{
    /**
     * @var bool[]
     */
    public $validations;

    /**
     * @var mixed[]
     */
    public $inputs;

    /**
     * Initializes the rule.
     *
     * @param bool[] ...$validations
     */
    public function __construct(bool ...$validations)
    {
        $this->validations = $validations;
    }

    /**
     * {@inheritDoc}
     */
    public function validate($input): bool
    {
        $this->inputs[] = $input;

        return (bool) array_shift($this->validations);
    }
}
