<?php

namespace Respect\Validation\Rules;

use DateTime;
use Respect\Validation\Rules\AbstractDate;
use Respect\Validation\Exceptions\InvalidDate;

class Date extends AbstractDate
{
    const MSG_INVALID_DATE = 'Date_1';
    const MSG_INVALID_FORMAT = 'Date_2';
    protected $messageTemplates = array(
        self::MSG_INVALID_DATE => '%s is not a valid date reference',
        self::MSG_INVALID_FORMAT => '%s is not a valid date in the %s format',
    );

    public function __construct($format=null)
    {
        $this->format = $format;
    }

    public function validate($input)
    {
        if ($input instanceof DateTime)
            return true;
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
                    sprintf($this->getMessageTemplate(static::MSG_INVALID_DATE),
                        $input)
                );
            else
                throw new InvalidDate(
                    sprintf(
                        $this->getMessageTemplate(static::MSG_INVALID_FORMAT),
                        $input, $this->format
                    )
                );


        return true;
    }

}