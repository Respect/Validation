<?php

namespace Respect\Validation\Exceptions;

class DateOutOfBoundsException extends InvalidException
{
    const MSG_OUT_OF_BOUNDS = 'DateBetween_1';

    protected $messageTemplates = array(
        self::MSG_OUT_OF_BOUNDS => '%s is not between %s and %s.'
    );

    public function __construct($input, $min, $max)
    {
        parent::__construct(
                sprintf(
                    $this->getMessageTemplate(self::MSG_OUT_OF_BOUNDS), $input,
                    $min, $max
                )
        );
    }

}