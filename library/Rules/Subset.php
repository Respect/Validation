<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use function array_diff;
use function is_array;

/**
 * Validates whether the input is a subset of a given value.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Singwai Chan <singwai.chan@live.com>
 */
final class Subset extends AbstractRule
{
    /**
     * @var mixed[]
     */
    private $superset;

    /**
     * Initializes the rule.
     *
     * @param mixed[] $superset
     */
    public function __construct(array $superset)
    {
        $this->superset = $superset;
    }

    /**
     * {@inheritDoc}
     */
    public function validate($input): bool
    {
        if (!is_array($input)) {
            return false;
        }

        return array_diff($input, $this->superset) === [];
    }
}
