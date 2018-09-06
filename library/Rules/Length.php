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

use Respect\Validation\Exceptions\ComponentException;

/**
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

    public function __construct(int $min = null, int $max = null, $inclusive = true)
    {
        $this->minValue = $min;
        $this->maxValue = $max;
        $this->inclusive = $inclusive;
        $paramValidator = new AnyOf(new NumericVal(), new NullType());
        if (!$paramValidator->validate($min)) {
            throw new ComponentException(
                sprintf('%s is not a valid numeric length', $min)
            );
        }

        if (!$paramValidator->validate($max)) {
            throw new ComponentException(
                sprintf('%s is not a valid numeric length', $max)
            );
        }

        if (!is_null($min) && !is_null($max) && $min > $max) {
            throw new ComponentException(
                sprintf('%s cannot be less than %s for validation', $min, $max)
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function validate($input): bool
    {
        $length = $this->extractLength($input);

        return $this->validateMin($length) && $this->validateMax($length);
    }

    protected function extractLength($input)
    {
        if (is_string($input)) {
            return mb_strlen($input, mb_detect_encoding($input));
        }

        if (is_array($input) || $input instanceof \Countable) {
            return count($input);
        }

        if (is_object($input)) {
            return count(get_object_vars($input));
        }

        if (is_int($input)) {
            return mb_strlen((string) $input);
        }

        return false;
    }

    protected function validateMin($length)
    {
        if (is_null($this->minValue)) {
            return true;
        }

        if ($this->inclusive) {
            return $length >= $this->minValue;
        }

        return $length > $this->minValue;
    }

    protected function validateMax($length)
    {
        if (is_null($this->maxValue)) {
            return true;
        }

        if ($this->inclusive) {
            return $length <= $this->maxValue;
        }

        return $length < $this->maxValue;
    }
}
