<?php

namespace Respect\Validation\Rules;

class Instance extends AbstractRule
{

    public $instanceName;

    public function __construct($instanceName)
    {
        $this->instanceName = $instanceName;
    }

    public function reportError($input, array $extraParams=array())
    {
        return parent::reportError($input, $extraParams);
    }

    public function validate($input)
    {
        return $input instanceof $this->instanceName;
    }

}
