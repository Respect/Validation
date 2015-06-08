<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Rules\Locale;

use malkusch\bav\BAV;
use Respect\Validation\Rules\AbstractRule;

/**
 * Validates a german bank.
 *
 * This validator depends on the composer package "malkusch/bav".
 *
 * @author Markus Malkusch <markus@malkusch.de>
 *
 * @see    BAV::isValidBank()
 */
class GermanBank extends AbstractRule
{
    /**
     * @var BAV
     */
    public $bav;

    /**
     * @param BAV $bav
     */
    public function __construct(BAV $bav = null)
    {
        if (null === $bav) {
            $bav = new BAV();
        }
        $this->bav = $bav;
    }

    /**
     * @return bool
     */
    public function validate($input)
    {
        return $this->bav->isValidBank($input);
    }
}
