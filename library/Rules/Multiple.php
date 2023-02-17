<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

/**
 * @author Danilo Benevides <danilobenevides01@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Jean Pimentel <jeanfap@gmail.com>
 */
final class Multiple extends AbstractRule
{
    /**
     * @var int
     */
    private $multipleOf;

    public function __construct(int $multipleOf)
    {
        $this->multipleOf = $multipleOf;
    }

    /**
     * {@inheritDoc}
     */
    public function validate($input): bool
    {
        if ($this->multipleOf == 0) {
            return $input == 0;
        }

        return $input % $this->multipleOf == 0;
    }
}
