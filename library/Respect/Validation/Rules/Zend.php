<?php

namespace Respect\Validation\Rules;

use ReflectionClass;

class Zend extends AbstractRule
{

    public $name;
    protected $messages = array();
    protected $zendValidator;

    public function __construct($name, $params=array())
    {
        $this->name = $name;
        $validatorName = explode('_', $name);
        $validatorName = array_map('ucfirst', $validatorName);
        $validatorName = implode('\\', $validatorName);
        $zendMirror = new ReflectionClass('Zend\Validator\\' . $validatorName);
        if ($zendMirror->hasMethod('__construct'))
            $this->zendValidator = $zendMirror->newInstanceArgs($params);
        else
            $this->zendValidator = $zendMirror->newInstance();
    }

    public function assert($input)
    {
        $exceptions = array();
        $validator = clone $this->zendValidator;
        
        if ($validator->isValid($input))
            return true;
        else
            foreach ($validator->getMessages() as $m)
                $exceptions[] = $this->reportError($m, get_object_vars($this));
        
        throw $this->reportError($input)->setRelated($exceptions);
    }

    public function validate($input)
    {
        $validator = clone $this->zendValidator;
        return $validator->isValid($input);
    }

}
