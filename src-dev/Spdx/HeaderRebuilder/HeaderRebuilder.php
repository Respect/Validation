<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Dev\Spdx\HeaderRebuilder;

use Respect\Dev\Spdx\Contributor;

interface HeaderRebuilder
{
    /** @param array<Contributor> $contributors */
    public function rebuild(string $content, array $contributors): string;
}
