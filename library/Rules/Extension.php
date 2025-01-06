<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use SplFileInfo;

use function is_string;
use function pathinfo;

use const PATHINFO_EXTENSION;

/**
 * Validate file extensions.
 *
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class Extension extends AbstractRule
{
    /**
     * @var string
     */
    private $extension;

    /**
     * Initializes the rule.
     */
    public function __construct(string $extension)
    {
        $this->extension = $extension;
    }

    /**
     * @deprecated Calling `validate()` directly from rules is deprecated. Please use {@see \Respect\Validation\Validator::isValid()} instead.
     */
    public function validate($input): bool
    {
        if ($input instanceof SplFileInfo) {
            return $this->extension === $input->getExtension();
        }

        if (!is_string($input)) {
            return false;
        }

        return $this->extension === pathinfo($input, PATHINFO_EXTENSION);
    }
}
