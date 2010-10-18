<?php

namespace Respect\Validation\Exceptions;

class InvalidIpException extends InvalidException
{
    const MSG_NOT_IP = 'Ip_1';
    public $options;
    protected $messageTemplates = array(
        self::MSG_NOT_IP => '%s is not a valid IP address'
    );

    public function __construct($input)
    {
        parent::__construct(
                sprintf(
                    $this->getMessageTemplate(self::MSG_NOT_IP), $input
                )
        );
    }

}