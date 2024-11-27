<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\InvalidRuleConstructorException;
use Respect\Validation\Message\Template;
use Respect\Validation\Rules\Core\Envelope;

use function array_map;
use function count;

#[Template(
    '{{name}} must contain at least one of the values {{needles}}',
    '{{name}} must not contain any of the values {{needles}}',
)]
final class ContainsAny extends Envelope
{
    /** @param non-empty-array<mixed> $needles */
    public function __construct(array $needles, bool $identical = false)
    {
        if (empty($needles)) {
            throw new InvalidRuleConstructorException('At least one value must be provided');
        }

        $rules = $this->getRules($needles, $identical);
        parent::__construct(
            count($rules) === 1 ? $rules[0] : new AnyOf(...$rules),
            ['needles' => $needles]
        );
    }

    /**
     * @param mixed[] $needles
     *
     * @return Contains[]
     */
    private function getRules(array $needles, bool $identical): array
    {
        return array_map(
            static function ($needle) use ($identical): Contains {
                return new Contains($needle, $identical);
            },
            $needles
        );
    }
}
