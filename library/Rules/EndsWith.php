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

use function end;
use function is_array;
use function mb_detect_encoding;
use function mb_strlen;
use function mb_strripos;
use function mb_strrpos;

/**
 * Validates only if the value is at the end of the input.
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Hugo Hamon <hugo.hamon@sensiolabs.com>
 * @author William Espindola <oi@williamespindola.com.br>
 */
final class EndsWith extends AbstractRule
{
    /**
     * @var mixed
     */
    public $endValue;

    /**
     * @var bool
     */
    public $identical;

    /**
     * @param mixed $endValue
     * @param bool $identical
     */
    public function __construct($endValue, bool $identical = false)
    {
        $this->endValue = $endValue;
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

    private function validateEquals($input): bool
    {
        if (is_array($input)) {
            return end($input) == $this->endValue;
        }

        return mb_strripos($input, $this->endValue, -1, $enc = mb_detect_encoding($input))
            === mb_strlen($input, $enc) - mb_strlen($this->endValue, $enc);
    }

    private function validateIdentical($input): bool
    {
        if (is_array($input)) {
            return end($input) === $this->endValue;
        }

        return mb_strrpos($input, $this->endValue, 0, $enc = mb_detect_encoding($input))
            === mb_strlen($input, $enc) - mb_strlen($this->endValue, $enc);
    }
}
