<?php

namespace Respect\Validation;

use LogicException;

class Chain extends CompositeValidator
{

    protected $input;
    protected $validators;

    public static function all($validator, $anotherValidator=null, $etc=null)
    {
        $validator = new static;
        foreach (func_get_args() as $v)
            if (!is_array($v))
                $validator->addValidator($v);
            else
                $validator->addValidators($v);
        return $validator;
    }

    public static function __callStatic($method, $arguments)
    {
        $validator = new static;
        $validator->__call($method, $arguments);
        return $validator;
    }

    public function __call($method, $arguments)
    {
        if (0 === strpos($method, 'valid'))
            foreach ($arguments as $a)
                if (!is_array($a))
                    $this->addValidator(substr($method, 5) . '\\' . $a);
                else
                    $this->addValidators($a, substr($method, 5));
        return $this;
    }

}