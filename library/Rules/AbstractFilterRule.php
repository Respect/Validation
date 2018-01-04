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

abstract class AbstractFilterRule extends AbstractRule
{
    public $additionalChars = '';

    abstract protected function validateClean($input);

    public function __construct($additionalChars = '')
    {
        if (!is_string($additionalChars)) {
            throw new ComponentException('Invalid list of additional characters to be loaded');
        }

        $this->additionalChars .= $additionalChars;
    }

    protected function filter($input)
    {
        return str_replace(str_split($this->additionalChars), '', $input);
    }

    public function validate($input)
    {
        if (!is_scalar($input)) {
            return false;
        }

        $stringInput = (string) $input;
        if ('' === $stringInput) {
            return false;
        }

        $cleanInput = $this->filter($stringInput);

        return '' === $cleanInput || $this->validateClean($cleanInput);
    }
}
