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

use function in_array;
use function mb_detect_encoding;
use function mb_stripos;
use function mb_strpos;

/**
 * Validates if the input can be found in a defined array or string.
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Danilo Benevides <danilobenevides01@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class In extends AbstractRule
{
    /**
     * @var array|string
     */
    private $haystack;

    /**
     * @var bool
     */
    private $compareIdentical;

    /**
     * Initializes the rule with the haystack and optionally compareIdentical flag.
     *
     * @param array|string $haystack
     * @param bool $compareIdentical
     */
    public function __construct($haystack, bool $compareIdentical = false)
    {
        $this->haystack = $haystack;
        $this->compareIdentical = $compareIdentical;
    }

    private function validateEquals($input): bool
    {
        if (is_array($this->haystack)) {
            return in_array($input, $this->haystack);
        }

        if (null === $input || '' === $input) {
            return $input == $this->haystack;
        }

        $inputString = (string) $input;

        return false !== mb_stripos($this->haystack, $inputString, 0, mb_detect_encoding($inputString));
    }

    private function validateIdentical($input): bool
    {
        if (is_array($this->haystack)) {
            return in_array($input, $this->haystack, true);
        }

        if (null === $input || '' === $input) {
            return $input === $this->haystack;
        }

        $inputString = (string) $input;

        return false !== mb_strpos($this->haystack, $inputString, 0, mb_detect_encoding($inputString));
    }

    /**
     * {@inheritdoc}
     */
    public function validate($input): bool
    {
        if ($this->compareIdentical) {
            return $this->validateIdentical($input);
        }

        return $this->validateEquals($input);
    }
}
