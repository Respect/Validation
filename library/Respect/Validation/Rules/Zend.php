<?php

namespace Respect\Validation\Rules;

use ReflectionClass;
use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Exceptions\CallbackException;
use Respect\Validation\Exceptions\ZendException;

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

    public function createException()
    {
        return new ZendException;
    }

    public function validate($input)
    {
        return $this->zendValidator->isValid($input);
    }

    public function assert($input)
    {
        if (!$this->validate($input)) {
            $exceptions = array();
            foreach ($this->zendValidator->getMessages() as $m) {
                $exceptions[] = ZendException::create()->configure($m);
            }
            throw $this->getException() ? : ZendException::create()
                    ->configure($exceptions);
        }
        return true;
    }

    public function check($input)
    {
        return $this->assert($input);
    }

}