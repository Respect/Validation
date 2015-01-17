<?php
namespace Respect\Validation\Rules\Locale;

use malkusch\bav\BAV;
use Respect\Validation\Rules\AbstractRule;

/**
 * Validates a german BIC (Bank Identifier Code).
 *
 * This validator depends on the composer package "malkusch/bav".
 *
 * Note: It is not recommended to use this validator with BAV's default
 * configuration. Use a configuration with one of the following
 * DataBackendContainer implementations:
 * PDODataBackendContainer or DoctrineBackendContainer.
 *
 * @author Markus Malkusch <markus@malkusch.de>
 * @see    BAV::isValidBIC()
 * @see    \malkusch\bav\Configuration
 * @see    \malkusch\bav\ConfigurationRegistry::setConfiguration()
 */
class GermanBic extends AbstractRule
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
     * @return boolean
     */
    public function validate($input)
    {
        return $this->bav->isValidBIC($input);
    }
}
