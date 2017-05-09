<?php
/**
 * @copyright Copyright (c) 2015 tuttur.com (http://www.tuttur.com)
 * @license Tuttur Commercial License
 * @author: Ahmet Güneş <ahmetgunes@mail.com>
 */

namespace Respect\Validation\Rules;

use Respect\Validation\Rules\Locale\Factory;

class Character extends AbstractWrapper
{
    /**
     * @param Factory $factory
     */
    public function __construct($countryCode, Factory $factory = null)
    {
        if (null === $factory) {
            $factory = new Factory($countryCode);
        }

        $this->validatable = $factory->character($countryCode);
    }
}
