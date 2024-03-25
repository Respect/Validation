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

use function max;

#[Template('As the maximum of {{name}},', 'As the maximum of {{name}},')]
#[Template('The maximum of', 'The maximum of', self::TEMPLATE_NAMED)]
final class Max extends FilteredNonEmptyArray
{
    public const TEMPLATE_NAMED = '__named__';

    /** @param non-empty-array<mixed> $input */
    protected function evaluateNonEmptyArray(array $input): Result
    {
        $result = $this->rule->evaluate(max($input))->withPrefixedId('max');
        $template = $this->getName() === null ? self::TEMPLATE_STANDARD : self::TEMPLATE_NAMED;

        return (new Result($result->isValid, $input, $this, [], $template, id: $result->id))->withNextSibling($result);
    }
}
