<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use Respect\Validation\Exceptions\InvalidRuleConstructorException;
use Respect\Validation\Message\Template;
use Respect\Validation\Rules\Core\Envelope;

use function array_map;
use function count;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{name}} must contain at least one value from {{needles}}',
    '{{name}} must not contain any value from {{needles}}',
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
