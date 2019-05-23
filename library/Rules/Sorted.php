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
use function array_values;
use function count;
use function is_array;
use function is_string;
use function sprintf;
use function str_split;

/**
 * Validates whether the input is sorted in a certain order or not.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Mikhail Vyrtsev <reeywhaar@gmail.com>
 */
final class Sorted extends AbstractRule
{
    public const ASCENDING = 'ASC';
    public const DESCENDING = 'DESC';

    /**
     * @var string
     */
    private $direction;

    public function __construct(string $direction)
    {
        if ($direction !== self::ASCENDING && $direction !== self::DESCENDING) {
            throw new ComponentException(
                sprintf('Direction should be either "%s" or "%s"', self::ASCENDING, self::DESCENDING)
            );
        }

        $this->direction = $direction;
    }

    /**
     * {@inheritDoc}
     */
    public function validate($input): bool
    {
        if (!is_array($input) && !is_string($input)) {
            return false;
        }

        $values = $this->getValues($input);
        $count = count($values);
        for ($position = 1; $position < $count; ++$position) {
            if (!$this->isSorted($values[$position], $values[$position - 1])) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param mixed $current
     * @param mixed $last
     */
    private function isSorted($current, $last): bool
    {
        if ($this->direction === self::ASCENDING) {
            return $current > $last;
        }

        return $current < $last;
    }

    /**
     * @param string|mixed[] $input
     *
     * @return mixed[]
     */
    private function getValues($input): array
    {
        if (is_array($input)) {
            return array_values($input);
        }

        return str_split($input);
    }
}
