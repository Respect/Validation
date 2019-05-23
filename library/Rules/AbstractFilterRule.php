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

use function implode;
use function is_scalar;
use function str_replace;
use function str_split;

/**
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Nick Lombard <github@jigsoft.co.za>
 */
abstract class AbstractFilterRule extends AbstractRule
{
    /**
     * @var string
     */
    private $additionalChars;

    /**
     * Initializes the rule with a list of characters to be ignored by the validation.
     */
    public function __construct(string ...$additionalChars)
    {
        $this->additionalChars = implode($additionalChars);
    }

    /**
     * {@inheritDoc}
     */
    public function validate($input): bool
    {
        if (!is_scalar($input)) {
            return false;
        }

        $stringInput = (string) $input;
        if ($stringInput === '') {
            return false;
        }

        $filteredInput = $this->filter($stringInput);

        return $filteredInput === '' || $this->validateFilteredInput($filteredInput);
    }

    abstract protected function validateFilteredInput(string $input): bool;

    private function filter(string $input): string
    {
        return str_replace(str_split($this->additionalChars), '', $input);
    }
}
