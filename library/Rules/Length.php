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

use Countable as CountableInterface;
use Respect\Validation\Exceptions\ComponentException;
use function count;
use function is_array;
use function is_int;
use function is_object;
use function is_string;
use function mb_detect_encoding;
use function mb_strlen;

/**
 * Validates the length of the given input.
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Blake Hair <blake.hair@gmail.com>
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Hugo Hamon <hugo.hamon@sensiolabs.com>
 * @author João Torquato <joao.otl@gmail.com>
 * @author Marcelo Araujo <msaraujo@php.net>
 */
final class Length extends AbstractRule
{
    /**
     * @var int
     */
    private $minValue;

    /**
     * @var int
     */
    private $maxValue;

    /**
     * @var bool
     */
    private $inclusive;

    /**
     * Creates the rule with a minimum and maximum value.
     *
     * @param int|null $min
     * @param int|null $max
     * @param bool $inclusive TRUE by default
     *
     * @throws ComponentException
     */
    public function __construct(int $min = null, int $max = null, $inclusive = true)
    {
        $this->minValue = $min;
        $this->maxValue = $max;
        $this->inclusive = $inclusive;

        if (null !== $max && $min > $max) {
            throw new ComponentException(sprintf('%d cannot be less than %d for validation', $min, $max));
        }
    }

    /**
     * {@inheritdoc}
     */
    public function validate($input): bool
    {
        $length = $this->extractLength($input);
        if (null === $length) {
            return false;
        }

        return $this->validateMin($length) && $this->validateMax($length);
    }

    private function extractLength($input): ?int
    {
        if (is_string($input)) {
            return mb_strlen($input, mb_detect_encoding($input));
        }

        if (is_array($input) || $input instanceof CountableInterface) {
            return count($input);
        }

        if (is_object($input)) {
            return $this->extractLength(get_object_vars($input));
        }

        if (is_int($input)) {
            return $this->extractLength((string) $input);
        }

        return null;
    }

    private function validateMin(int $length): bool
    {
        if (null === $this->minValue) {
            return true;
        }

        if ($this->inclusive) {
            return $length >= $this->minValue;
        }

        return $length > $this->minValue;
    }

    private function validateMax(int $length): bool
    {
        if (null === $this->maxValue) {
            return true;
        }

        if ($this->inclusive) {
            return $length <= $this->maxValue;
        }

        return $length < $this->maxValue;
    }
}
