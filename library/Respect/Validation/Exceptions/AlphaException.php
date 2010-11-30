<?php

namespace Respect\Validation\Exceptions;

class AlphaException extends InvalidException
{
    const MSG_NOT_ALPHA = 'Alpha_1';
    const MSG_NOT_ALPHA_ADDITIONAL = 'Alpha_2';
    protected $messageTemplates = array(
        self::MSG_NOT_ALPHA => '"%s" does not contains only letters',
        self::MSG_NOT_ALPHA_ADDITIONAL => '"%s" does not contains only letters (including "%s")'
    );

    public function __construct($input, $additionalChars='')
    {
        $code = empty($additionalChars) ? self::MSG_NOT_ALPHA : self::MSG_NOT_ALPHA_ADDITIONAL;
        parent::__construct(
                sprintf(
                    $this->getMessageTemplate($code),
                    $this->getStringRepresentation($input), $additionalChars
                )
        );
    }

}