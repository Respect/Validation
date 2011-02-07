<?php

namespace Respect\Validation\Rules;

use ReflectionClass;

class Zend extends AbstractRule
{

    protected $messages = array();
    protected $zendValidator;

    public function __construct($name, $params=array())
    {
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
        if (!$this->validate($input)) {
            $exceptions = array();
            foreach ($this->zendValidator->getMessages() as $m) {
                $exceptions[] = $this->createException()->configure($m);
            }
            throw $this->reportError($input, $exceptions);
        }
        return true;
    }

    public function validate($input)
    {
        return $this->zendValidator->isValid($input);
    }

}