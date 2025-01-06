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

/**
 * Validates the type of input.
 *
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Paul Karikari <paulkarikari1@gmail.com>
 */
final class Type extends AbstractRule
{
    /**
     * Collection of available types for validation.
     *
     */
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
     * Type to validate input against.
     *
     * @var string
     */
    private $type;

    /**
     * Initializes the rule.
     *
     * @throws ComponentException When $type is not a valid one
     */
    public function __construct(string $type)
    {
        if (!isset(self::AVAILABLE_TYPES[$type])) {
            throw new ComponentException(
                sprintf(
                    '"%s" is not a valid type (Available: %s)',
                    $type,
                    implode(', ', array_keys(self::AVAILABLE_TYPES))
                )
            );
        }

        $this->type = $type;
    }

    /**
     * @deprecated Calling `validate()` directly from rules is deprecated. Please use {@see \Respect\Validation\Validator::isValid()} instead.
     */
    public function validate($input): bool
    {
        if ($this->type === 'callable') {
            return is_callable($input);
        }

        return self::AVAILABLE_TYPES[$this->type] === gettype($input);
    }
}
