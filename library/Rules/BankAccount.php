<?php
namespace Respect\Validation\Rules;

use Respect\Validation\Rules\Locale\Factory;

class BankAccount extends AbstractWrapper
{
    /**
     * Defines the country code and bank.
     *
     * The country code is not case sensitive.
     *
     * @param string  $countryCode The ISO 639-1 country code.
     * @param string  $bank        The bank.
     * @param Factory $factory
     */
    public function __construct($countryCode, $bank, Factory $factory = null)
    {
        if (null === $factory) {
            $factory = new Factory();
        }

        $this->validatable = $factory->bankAccount($countryCode, $bank);
    }
}
