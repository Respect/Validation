<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Rules\Core\FilteredNonEmptyArray;

use function min;

#[Template('As the minimum from {{name}},', 'As the minimum from {{name}},')]
#[Template('The minimum from', 'The minimum from', self::TEMPLATE_NAMED)]
final class Min extends FilteredNonEmptyArray
{
    public const TEMPLATE_NAMED = '__named__';

    /** @param non-empty-array<mixed> $input */
    protected function evaluateNonEmptyArray(array $input): Result
    {
        $result = $this->rule->evaluate(min($input));
        $template = $this->getName() === null ? self::TEMPLATE_STANDARD : self::TEMPLATE_NAMED;

        return (new Result($result->isValid, $input, $this, [], $template))->withNextSibling($result);
    }
}
