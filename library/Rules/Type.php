<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\ComponentException;

use function array_keys;
use function gettype;
use function implode;
use function is_callable;
use function sprintf;

final class Type extends AbstractRule
{
    private const AVAILABLE_TYPES = [
        'array' => 'array',
        'bool' => 'boolean',
        'boolean' => 'boolean',
        'callable' => 'callable',
        'double' => 'double',
        'float' => 'double',
        'int' => 'integer',
        'integer' => 'integer',
        'null' => 'NULL',
        'object' => 'object',
        'resource' => 'resource',
        'string' => 'string',
    ];

    /**
     * @throws ComponentException When $type is not a valid one
     */
    public function __construct(
        private readonly string $type
    ) {
        if (!isset(self::AVAILABLE_TYPES[$type])) {
            throw new ComponentException(
                sprintf(
                    '"%s" is not a valid type (Available: %s)',
                    $type,
                    implode(', ', array_keys(self::AVAILABLE_TYPES))
                )
            );
        }
    }

    public function validate(mixed $input): bool
    {
        if ($this->type === 'callable') {
            return is_callable($input);
        }

        return self::AVAILABLE_TYPES[$this->type] === gettype($input);
    }
}
