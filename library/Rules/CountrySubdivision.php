<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\ComponentException;

/**
 * Validates country subdivision codes according to ISO 3166-2.
 *
 * @link http://en.wikipedia.org/wiki/ISO_3166-2
 * @link http://www.geonames.org/countries/
 */
class CountrySubdivision extends AbstractWrapper
{
    public $entry;

    protected $validatable;

    public function __construct($entry)
    {
        $shortName = ucfirst(strtolower($entry)).'CountrySubdivision';
        $className = __NAMESPACE__.'\\Locale\\'.$shortName;
        if (!class_exists($className)) {
            throw new ComponentException(sprintf('"%s" is not a valid entry for ISO 3166-2', $entry));
        }

        $this->entry        = $entry;
        $this->validatable  = new $className();
    }
}
