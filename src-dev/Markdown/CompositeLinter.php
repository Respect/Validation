<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Dev\Markdown;

final readonly class CompositeLinter implements Linter
{
    /** @var array<Linter> */
    private array $linters;

    public function __construct(Linter $linter, Linter ...$linters)
    {
        $this->linters = [$linter, ...$linters];
    }

    public function lint(File $file): File
    {
        foreach ($this->linters as $linter) {
            $file = $linter->lint($file);
        }

        return $file;
    }
}
