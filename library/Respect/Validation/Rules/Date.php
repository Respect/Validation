<?php

namespace Respect\Validation\Rules;

use DateTime;

class Date extends AbstractRule
{
    const FORMAT_DEFAULT = DateTime::RFC1036;
    protected $format = self::FORMAT_DEFAULT;

    protected function formatDate(DateTime $date)
    {
        return $date->format($this->format);
    }

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
            throw $this->getException() ? : $this->createException()
                    ->configure($input, $this->format);
        return true;
    }

}