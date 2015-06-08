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

use Respect\Validation\Rules\Locale\Factory;

class Bic extends AbstractWrapper
{
    /**
     * Defines the country code.
     *
     * The country code is not case sensitive.
     *
     * @param string  $countryCode The ISO 639-1 country code.
     * @param Factory $factory
     */
    public function __construct($countryCode, Factory $factory = null)
    {
        if (null === $factory) {
            $factory = new Factory();
        }

        $this->validatable = $factory->bic($countryCode);
    }
}
