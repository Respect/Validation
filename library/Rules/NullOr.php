<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Rules\Core\Wrapper;

use function array_map;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    'or must be null',
    'and must not be null',
)]
final class NullOr extends Wrapper
{
    public function evaluate(mixed $input): Result
    {
        $result = $this->rule->evaluate($input);
        if ($input !== null) {
            return $this->enrichResult($result);
        }

        if (!$result->isValid) {
            return $this->enrichResult($result->withInvertedValidation());
        }

        return $this->enrichResult($result);
    }

    private function enrichResult(Result $result): Result
    {
        if ($result->allowsSubsequent()) {
            return $result
                ->withPrefixedId('nullOr')
                ->withSubsequent(new Result($result->isValid, $result->input, $this));
        }

        return $result->withChildren(...array_map(fn(Result $child) => $this->enrichResult($child), $result->children));
    }
}
