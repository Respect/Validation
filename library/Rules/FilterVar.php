<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\ComponentException;

use function array_key_exists;
use function filter_var;
use function is_array;
use function is_int;

use const FILTER_VALIDATE_BOOLEAN;
use const FILTER_VALIDATE_DOMAIN;
use const FILTER_VALIDATE_EMAIL;
use const FILTER_VALIDATE_FLOAT;
use const FILTER_VALIDATE_INT;
use const FILTER_VALIDATE_IP;
use const FILTER_VALIDATE_REGEXP;
use const FILTER_VALIDATE_URL;

/**
 * Validates the input with the PHP's filter_var() function.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class FilterVar extends AbstractEnvelope
{
    private const ALLOWED_FILTERS = [
        FILTER_VALIDATE_BOOLEAN => 'is_bool',
        FILTER_VALIDATE_DOMAIN => 'is_string',
        FILTER_VALIDATE_EMAIL => 'is_string',
        FILTER_VALIDATE_FLOAT => 'is_float',
        FILTER_VALIDATE_INT => 'is_int',
        FILTER_VALIDATE_IP => 'is_string',
        FILTER_VALIDATE_REGEXP => 'is_string',
        FILTER_VALIDATE_URL => 'is_string',
    ];

    /**
     * Initializes the rule.
     *
     * @param mixed $options
     *
     * @throws ComponentException
     */
    public function __construct(int $filter, $options = null)
    {
        if (!array_key_exists($filter, self::ALLOWED_FILTERS)) {
            throw new ComponentException('Cannot accept the given filter');
        }

        $arguments = [$filter];
        if (is_array($options) || is_int($options)) {
            $arguments[] = $options;
        }

        parent::__construct(new Callback(static function ($input) use ($filter, $arguments) {
            return (self::ALLOWED_FILTERS[$filter])(
                filter_var($input, ...$arguments)
            );
        }));
    }
}
