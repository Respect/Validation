<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Attributes\Template;
use SplFileInfo;

use function is_string;
use function pathinfo;

use const PATHINFO_EXTENSION;

#[Template(
    '{{name}} must have {{extension}} extension',
    '{{name}} must not have {{extension}} extension',
)]
final class Extension extends AbstractRule
{
    public function __construct(
        private readonly string $extension
    ) {
    }

    public function validate(mixed $input): bool
    {
        if ($input instanceof SplFileInfo) {
            return $this->extension === $input->getExtension();
        }

        if (!is_string($input)) {
            return false;
        }

        return $this->extension === pathinfo($input, PATHINFO_EXTENSION);
    }

    /**
     * @return array<string, string>
     */
    public function getParams(): array
    {
        return ['extension' => $this->extension];
    }
}
