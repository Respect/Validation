<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Helpers\CanValidateUndefined;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Rules\Core\Wrapper;

use function array_map;

#[Template(
    'or must be undefined',
    'and must not be undefined',
)]
final class UndefOr extends Wrapper
{
    use CanValidateUndefined;

    public function evaluate(mixed $input): Result
    {
        $result = $this->rule->evaluate($input);
        if (!$this->isUndefined($input)) {
            return $this->enrichResult($result);
        }

        if (!$result->isValid) {
            return $this->enrichResult($result->withInvertedValidation());
        }

        return $this->enrichResult($result);
    }

    private function enrichResult(Result $result): Result
    {
        if ($result->isSiblingCompatible()) {
            return $result
                ->withPrefixedId('undefOr')
                ->withNextSibling(new Result($result->isValid, $result->input, $this));
        }

        return $result->withChildren(...array_map(fn(Result $child) => $this->enrichResult($child), $result->children));
    }
}
