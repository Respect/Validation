<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Exceptions\IpException;

class Ip extends AbstractRule
{

    public function __construct($options=null)
    {
        $this->options = $options;
    }

    public function createException()
    {
        return new IpException;
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
            throw $this
                ->getException()
                ->setParams($input);
        return true;
    }

    public function check($input)
    {
        return $this->assert($input);
    }

}