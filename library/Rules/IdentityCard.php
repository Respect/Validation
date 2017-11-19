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

class IdentityCard extends AbstractWrapper
{
    public $countryCode;

    public function __construct($countryCode)
    {
        $shortName = ucfirst(mb_strtolower($countryCode)).'IdentityCard';
        $className = __NAMESPACE__.'\\Locale\\'.$shortName;
        if (!class_exists($className)) {
            throw new ComponentException(sprintf('There is no support for identity cards from "%s"', $countryCode));
        }

        $this->countryCode = $countryCode;
        $this->validatable = new $className();
    }
}
