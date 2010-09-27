<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Rules\AbstractDate;
use Respect\Validation\Exceptions\InvalidDate;
use Respect\Validation\Validatable;

class Date extends AbstractDate implements Validatable
{
    const MSG_INVALID_DATE = 'Date_1';
    const MSG_INVALID_FORMAT = 'Date_2';
    protected $messages = array(
        self::MSG_INVALID_DATE => '%s is not a valid date reference',
        self::MSG_INVALID_FORMAT => '%s is not a valid date in the %s format',
    );

    public function __construct($format=null)
    {
        $this->format = $format;
    }

    public function validate($input)
    {
        if (is_null($this->format))
            return (boolean) strtotime($input);
        else
            return date($this->format, strtotime($input)) == $input;
    }

    public function assert($input)
    {
        if (!$this->validate($input))
            if (is_null($this->format))
                throw new InvalidDate(
                    sprintf($this->getMessage(static::MSG_INVALID_DATE), $input)
                );
            else
                throw new InvalidDate(
                    sprintf(
                        $this->getMessage(static::MSG_INVALID_FORMAT), $input,
                        $this->format
                    )
                );


        return true;
    }

}