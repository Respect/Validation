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

    public function validate($input)
    {
        return filter_var(
            $input, FILTER_VALIDATE_IP, array('flags' => $this->options)
        );
    }

    public function assert($input)
    {
        if (!$this->validate($input))
            throw new IpException($input);
        return true;
    }

    public function check($input)
    {
        return $this->assert($input);
    }

}