<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Dev\Spdx\ContributorExtractor;

use Respect\Dev\Spdx\Contributor;

interface ContributorExtractor
{
    /** @return array<Contributor> */
    public function extract(string $filepath): array;
}
