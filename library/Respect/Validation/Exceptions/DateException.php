<?php

namespace Respect\Validation\Exceptions;

class DateException extends InvalidException
{
    const MSG_INVALID_DATE = 'Date_1';
    const MSG_INVALID_FORMAT = 'Date_2';
    protected $messageTemplates = array(
        self::MSG_INVALID_DATE => '%s is not a valid date reference',
        self::MSG_INVALID_FORMAT => '%s is not a valid date in the %s format',
    );

    public function __construct($input, $format)
    {
        $code = is_null($format) ? static::MSG_INVALID_DATE : static::MSG_INVALID_FORMAT;
        parent::__construct(
                sprintf(
                    $this->getMessageTemplate($code), $input, $format
                )
        );
    }

}