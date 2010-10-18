<?php

namespace Respect\Validation\Exceptions;

class NotAlphanumericException extends InvalidException
{
    const MSG_NOT_ALPHANUMERIC = 'Alnum_1';
    const MSG_NOT_ALPHANUMERIC_ADDITIONAL = 'Alnum_2';
    protected $messageTemplates = array(
        self::MSG_NOT_ALPHANUMERIC => '"%s" does not contains only letters and digits',
        self::MSG_NOT_ALPHANUMERIC_ADDITIONAL => '"%s" does not contains only letters and digits (including "%s")'
    );

    public function __construct($input, $additionalChars='')
    {
        $code = empty($additionalChars) ? self::MSG_NOT_ALPHANUMERIC : self::MSG_NOT_ALPHANUMERIC_ADDITIONAL;
        parent::__construct(
                sprintf(
                    $this->getMessageTemplate($code),
                    $this->getStringRepresentation($input), $additionalChars
                )
        );
    }

}