<?php

namespace Respect\Validation\Rules;

class Ip extends AbstractRule
{

    public $ipOptions;

    public function __construct($ipOptions=null)
    {
        $this->ipOptions = $ipOptions;
    }

    public function validate($input)
    {
        return filter_var(
            $input, FILTER_VALIDATE_IP, array('flags' => $this->ipOptions)
        );
    }

}
