<?php

namespace Respect\Validation\Rules;

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

}