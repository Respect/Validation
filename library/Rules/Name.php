<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Rules;

use Spoofchecker;

class Name extends AbstractRule
{
    public $locale;
    public $spoofchecker;

    public function __construct($locale = null)
    {
        $spoofchecker = new Spoofchecker();
        $spoofchecker->setChecks(Spoofchecker::SINGLE_SCRIPT | Spoofchecker::INVISIBLE);

        if (null !== $locale) {
            $spoofchecker->setAllowedLocales($locale);
        }

        $this->locale = $locale;
        $this->spoofchecker = $spoofchecker;
    }

    public function validate($input)
    {
        if (!is_scalar($input)) {
            return false;
        }

        return false === $this->spoofchecker->isSuspicious($input);
    }
}
