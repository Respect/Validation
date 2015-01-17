<?php
namespace Respect\Validation\Rules;

use malkusch\bav\BAV;
use Respect\Validation\Exceptions\ComponentException;

/**
 * Validates a bank account for a given bank.
 *
 * Currently only German validation is supported (country code "de").
 * This validator depends on the composer package malkusch/bav.
 *
 * @author Markus Malkusch <markus@malkusch.de>
 * @see BAV::isValidBankAccount()
 */
class BankAccount extends Callback
{
    /**
     * Sets the country code and bank.
     *
     * The country code is not case sensitive.
     *
     * @param string $countryCode The ISO 639-1 country code.
     * @param string $bank        The bank.
     */
    public function __construct($countryCode, $bank)
    {
        $lowerCountryCode = strtolower($countryCode);
        switch ($lowerCountryCode) {
            case 'de':
                $bav = new BAV();
                $callback = function ($account) use ($bank, $bav) {
                    return $bav->isValidBankAccount($bank, $account);
                };
                break;

            default:
                throw new ComponentException(sprintf('Cannot validate bank account for country "%s"', $countryCode));
        }

        parent::__construct($callback);
    }
}
