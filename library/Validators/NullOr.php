<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Fabio Ribeiro <faabiosr@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Jens Segers <segers.jens@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Validators\Core\Wrapper;

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
        $result = $this->validator->evaluate($input);
        if ($input !== null) {
            return $this->enrichResult($result);
        }

        if (!$result->hasPassed) {
            return $this->enrichResult($result->withToggledValidation());
        }

        return $this->enrichResult($result);
    }

    private function enrichResult(Result $result): Result
    {
        if ($result->allowsAdjacent()) {
            return $result
                ->withId($result->id->withPrefix('nullOr'))
                ->withAdjacent(Result::of($result->hasPassed, $result->input, $this));
        }

        return $result->withChildren(...array_map(fn(Result $child) => $this->enrichResult($child), $result->children));
    }
}
