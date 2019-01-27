<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use function array_diff;
use function is_array;

/**
 * Validates whether the input is a subset of a given value.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Singwai Chan <singwai.chan@live.com>
 */
final class Subset extends AbstractRule
{
    /**
     * @var array
     */
    private $superset;

    /**
     * Initializes the rule.
     *
     * @param array $superset
     */
    public function __construct(array $superset)
    {
        $this->superset = $superset;
    }

    /**
     * {@inheritdoc}
     */
    public function validate($input): bool
    {
        if (!is_array($input)) {
            return false;
        }

        return [] === array_diff($input, $this->superset);
    }
}
