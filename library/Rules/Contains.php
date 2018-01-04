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

use Respect\Validation\Result;
use Respect\Validation\Rule;

/**
 * Validates if the input contains some value.
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Henrique Moody <henriquemoody@gmail.com>
 *
 * @since 0.3.9
 */
final class Contains implements Rule
{
    /**
     * @var mixed
     */
    private $expectedValue;

    /**
     * @var bool
     */
    private $identical;

    /**
     * Initializes the rule.
     *
     * @param mixed $expectedValue
     * @param bool  $identical
     */
    public function __construct($expectedValue, bool $identical = false)
    {
        $this->expectedValue = $expectedValue;
        $this->identical = $identical;
    }

    /**
     * {@inheritdoc}
     */
    public function apply($input): Result
    {
        if (is_array($input)) {
            return new Result(in_array($this->expectedValue, $input, $this->identical), $input, $this);
        }

        $stringValResult = (new StringVal())->apply($input);
        if (!$stringValResult->isValid()) {
            return new Result(false, $input, $this, [], $stringValResult);
        }

        $encoding = mb_detect_encoding($input);
        if ($this->identical) {
            return new Result($this->isIdenticalToExpectedValue($input, $encoding), $input, $this);
        }

        return new Result($this->isEqualToExpectedValue($input, $encoding), $input, $this);
    }

    /**
     * Verifies if the input is equal to the expected value.
     *
     * @param string $input
     * @param string $encoding
     *
     * @return bool
     */
    private function isEqualToExpectedValue(string $input, string $encoding): bool
    {
        return false !== mb_stripos($input, $this->expectedValue, 0, $encoding);
    }

    /**
     * Verifies if the input is identical to the expected value.
     *
     * @param string $input
     * @param string $encoding
     *
     * @return bool
     */
    private function isIdenticalToExpectedValue(string $input, string $encoding): bool
    {
        return false !== mb_strpos($input, $this->expectedValue, 0, $encoding);
    }
}
