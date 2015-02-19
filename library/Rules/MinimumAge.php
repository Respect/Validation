<?php
namespace Respect\Validation\Rules;

use DateTime;

/**
 * @deprecated
 */
class MinimumAge extends Age
{
    public function __construct($min, $max = null)
    {
        parent::__construct($min, $max = null);
        trigger_error("Use Age instead.", E_USER_DEPRECATED);
    }
}
