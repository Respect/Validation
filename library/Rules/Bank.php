<?php
namespace Respect\Validation\Rules;

use malkusch\bav\BAV;
use Respect\Validation\Exceptions\ComponentException;

/**
 * Validates a bank.
 *
 * Currently only German validation is supported (country code "de").
 * This validator depends on the composer package malkusch/bav.
 *
 * @author Markus Malkusch <markus@malkusch.de>
 * @see BAV::isValidBank()
 */
class Bank extends Callback
{
    
    /**
     * Sets the country code.
     *
     * The country code is not case sensitive.
     *
     * @param string $countryCode The ISO 639-1 country code.
     */
    public function __construct($countryCode)
    {
        $callback = null;

        switch (strtolower($countryCode)) {
            case "de":
                $bav = new BAV();
                $callback = function ($bank) use ($bav) {
                    return $bav->isValidBank($bank);
                };
                break;
                
            default:
                $message = sprintf(
                    "Cannot validate bank for country '%s'.",
                    $countryCode
                );
                throw new ComponentException($message);
        }
        
        parent::__construct($callback);
    }
}
