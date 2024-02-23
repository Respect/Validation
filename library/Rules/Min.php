<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Message\Template;
use Respect\Validation\Result;

use function count;
use function is_array;
use function is_iterable;
use function iterator_to_array;
use function min;

#[Template('As the minimum from {{name}},', 'As the minimum from {{name}},')]
#[Template('The minimum from', 'The minimum from', self::TEMPLATE_NAMED)]
#[Template('{{name}} must have at least 1 item', '{{name}} must not have at least 1 item', self::TEMPLATE_EMPTY)]
#[Template(
    '{{name}} must be an array or iterable to validate its minimum value',
    '{{name}} must not be an array or iterable to validate its minimum value',
    self::TEMPLATE_TYPE,
)]
final class Min extends Wrapper
{
    public const TEMPLATE_NAMED = '__named__';
    public const TEMPLATE_EMPTY = '__empty__';
    public const TEMPLATE_TYPE = '__min__';

    public function evaluate(mixed $input): Result
    {
        if (!is_iterable($input)) {
            return Result::failed($input, $this);
        }

        $array = $this->toArray($input);
        if (count($array) === 0) {
            return Result::failed($input, $this);
        }

        $result = $this->rule->evaluate(min($array));
        $template = $this->getName() === null ? self::TEMPLATE_STANDARD : self::TEMPLATE_NAMED;

        return (new Result($result->isValid, $input, $this, [], $template,))->withNextSibling($result);
    }

    /**
     * @param iterable<mixed> $input
     * @return array<mixed>
     */
    private function toArray(iterable $input): array
    {
        if (is_array($input)) {
            return $input;
        }

        return iterator_to_array($input);
    }
}
