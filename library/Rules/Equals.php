<?php
namespace Respect\Validation\Rules;

class Equals extends AbstractRule
{
    public $compareIdentical = false;
    public $compareTo = null;

    public function __construct($compareTo, $compareIdentical=false)
    {
        $this->compareTo = $compareTo;
        $this->compareIdentical = $compareIdentical;
    }

    public function reportError($input, array $extraParams=array())
    {
        return parent::reportError($input, $extraParams);
    }

    public function validate($input)
    {
        if ($this->compareIdentical) {
            return $input === $this->compareTo;
        } else {
            return $input == $this->compareTo;
        }
    }
}

