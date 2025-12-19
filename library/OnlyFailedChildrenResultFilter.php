<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
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

            $children[] = $this->filter($child->getDeepestPath() ? $child->withId($child->getDeepestPath()) : $child);
        }

        if ($children === []) {
            return $result;
        }

        return $result->withChildren(...$children);
    }
}
