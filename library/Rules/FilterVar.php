<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\ComponentException;

use function in_array;
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
        FILTER_VALIDATE_BOOLEAN,
        FILTER_VALIDATE_DOMAIN,
        FILTER_VALIDATE_EMAIL,
        FILTER_VALIDATE_FLOAT,
        FILTER_VALIDATE_INT,
        FILTER_VALIDATE_IP,
        FILTER_VALIDATE_REGEXP,
        FILTER_VALIDATE_URL,
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
        if (!in_array($filter, self::ALLOWED_FILTERS)) {
            throw new ComponentException('Cannot accept the given filter');
        }

        $arguments = [$filter];
        if (is_array($options) || is_int($options)) {
            $arguments[] = $options;
        }

        parent::__construct(new Callback('filter_var', ...$arguments));
    }
}
