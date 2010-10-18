<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Exceptions\InvalidIpException;

class Ip extends AbstractRule
{
    const MSG_NOT_IP = 'Ip_1';
    public $options;
    protected $messageTemplates = array(
        self::MSG_NOT_IP => '%s is not a valid IP address'
    );

    public function __construct($options=null)
    {
        $this->options = $options;
    }

    public function validate($input)
    {
        return filter_var(
            $input, FILTER_VALIDATE_IP, array('flags' => $this->options)
        );
    }

    public function assert($input)
    {
        if (!$this->validate($input))
            throw new InvalidIpException(
                sprintf($this->getMessageTemplate(self::MSG_NOT_IP), $input)
            );
        return true;
    }

}