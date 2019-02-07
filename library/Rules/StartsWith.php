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

/**
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Marcelo Araujo <msaraujo@php.net>
 */
class StartsWith extends AbstractRule
{
    /**
     * @var mixed
     */
    public $startValue;

    /**
     * @var bool
     */
    public $identical;

    /**
     * @param mixed $startValue
     */
    public function __construct($startValue, bool $identical = false)
    {
        $this->startValue = $startValue;
        $this->identical = $identical;
    }

    /**
     * {@inheritdoc}
     */
    public function validate($input): bool
    {
        if ($this->identical) {
            return $this->validateIdentical($input);
        }

        return $this->validateEquals($input);
    }

    /**
     * @param mixed $input
     */
    protected function validateEquals($input): bool
    {
        if (is_array($input)) {
            return reset($input) == $this->startValue;
        }

        return 0 === mb_stripos($input, $this->startValue, 0, mb_detect_encoding($input));
    }

    /**
     * @param mixed $input
     */
    protected function validateIdentical($input): bool
    {
        if (is_array($input)) {
            return reset($input) === $this->startValue;
        }

        return 0 === mb_strpos($input, $this->startValue, 0, mb_detect_encoding($input));
    }
}
