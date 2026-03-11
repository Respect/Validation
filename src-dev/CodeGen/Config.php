<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Dev\CodeGen;

final readonly class Config
{
    public function __construct(
        public string $sourceDir,
        public string $sourceNamespace,
        public string $outputDir,
        public string $outputNamespace,
        public OutputFormatter $outputFormatter = new OutputFormatter(),
    ) {
    }
}
