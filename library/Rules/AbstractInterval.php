<?php
namespace Respect\Validation\Rules;

use Exception;
use DateTime;

abstract class AbstractInterval extends AbstractRule
{
    public $interval;
    public $inclusive;

    public function __construct($interval, $inclusive = false)
    {
        $this->interval  = $interval;
        $this->inclusive = $inclusive;
    }

    protected function filterInterval($value)
    {
        if (!is_string($value) || is_numeric($value) || empty($value)) {
            return $value;
        }

        if (strlen($value) == 1) {
            return $value;
        }

        try {
            return new DateTime($value);
        } catch (Exception $e) {
            // Pokémon Exception Handling
        }

        return $value;
    }
}
