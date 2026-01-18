<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

use function array_map;
use function array_pop;
use function count;
use function current;
use function implode;
use function is_scalar;
use function sprintf;

final class InvalidValidatorException extends ComponentException implements Exception
{
    /** @param string|array<string> ...$arguments */
    public function __construct(string $message, string|array ...$arguments)
    {
        parent::__construct(sprintf(
            $message,
            ...array_map(
                static function (array|string $value) {
                    if (is_scalar($value)) {
                        return $value;
                    }

                    if (count($value) === 1) {
                        return '"' . current($value) . '"';
                    }

                    $items = array_map(static fn($item) => '"' . $item . '"', $value);
                    $items[] = 'and ' . array_pop($items);

                    return implode(count($items) > 2 ? ', ' : ' ', $items);
                },
                $arguments,
            ),
        ));
    }
}
