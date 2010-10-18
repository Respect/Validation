<?php

namespace Respect\Validation\Rules;

use DateTime;
use Respect\Validation\Rules\AbstractDate;
use Respect\Validation\Exceptions\InvalidDate;

class Date extends AbstractDate
{

    public function __construct($format=null)
    {
        $this->format = $format;
    }

    public function validate($input)
    {
        if ($input instanceof DateTime)
            return true;
        if (!is_string($input))
            return false;
        if (is_null($this->format))
            return (boolean) strtotime($input);
        else
            return date($this->format, strtotime($input)) == $input;
    }

    public function assert($input)
    {
        if (!$this->validate($input))
            throw new InvalidDate($input, $this->format);
        return true;
    }

    public function check($input)
    {
        return $this->assert($input);
    }

}