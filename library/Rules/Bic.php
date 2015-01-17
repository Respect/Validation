<?php
namespace Respect\Validation\Rules;

use malkusch\bav\BAV;
use Respect\Validation\Exceptions\ComponentException;

/**
 * Validates a BIC (Bank Identifier Code).
 *
 * Currently only German BIC validation is supported (country code "de").
 * The German validator depends on the composer package malkusch/bav.
 * Note: It is not recommended to use this validator with BAV's default
 * configuration. Use a configuration with one of the following
 * DataBackendContainer implementations:
 * PDODataBackendContainer or DoctrineBackendContainer.
 *
 * @author Markus Malkusch <markus@malkusch.de>
 * @see BAV::isValidBIC()
 * @see \malkusch\bav\Configuration
 * @see \malkusch\bav\ConfigurationRegistry::setConfiguration()
 */
class Bic extends Callback
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
        $lowerCountryCode = strtolower($countryCode);
        switch ($lowerCountryCode) {
            case 'de':
                $callback = array(new BAV(), 'isValidBIC');
                break;

            default:
                throw new ComponentException(sprintf('Cannot validate BIC for country "%s"', $countryCode));
        }

        parent::__construct($callback);
    }
}
