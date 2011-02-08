<?php

namespace Respect\Validation\Rules;

class Equals extends AbstractRule
{

    protected $identical = false;
    protected $param = null;

    public function __construct($param, $identical=false)
    {
        $this->param = $param;
        $this->identical = $identical;
    }

    public function reportError($input, array $related=array())
    {
        return parent::reportError($input, $related, $this->param,
            $this->identical);
    }

    public function validate($input)
    {
        if ($this->identical)
            return $input === $this->param;
        else
            return $input == $this->param;
    }

}