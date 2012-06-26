<?php

namespace Respect\Validation\Rules;

use DateTime;

class Today extends AbstractRule
{

    public $format = null;

    public function __construct($format='Y-m-d')
    {
        $this->format = $format;
    }

    public function validate($input)
    {
        $dateValidation = new Date($this->format);
        if (!$dateValidation->validate($input))
            return false;

        if (is_string($input)) {
            $input = DateTime::createFromFormat($this->format, $input);
        }
        
        $today = new DateTime('today');

        return $today->format($this->format) === $input->format($this->format);
    }

}