<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\DateException;
use DateTime;
use Respect\Validation\Rules\AbstractRule;

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
            throw $this->getException() ? : DateException::create()
                    ->configure($input, $this->format);
        return true;
    }

    public function check($input)
    {
        return $this->assert($input);
    }

}