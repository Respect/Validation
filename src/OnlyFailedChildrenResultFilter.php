<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation;

final readonly class OnlyFailedChildrenResultFilter implements ResultFilter
{
    public function filter(Result $result): Result
    {
        $children = [];
        foreach ($result->children as $child) {
            if ($child->hasPassed) {
                continue;
            }

            $children[] = $this->filter($child);
        }

        if ($children === []) {
            return $result;
        }

        return $result->withChildren(...$children);
    }
}
