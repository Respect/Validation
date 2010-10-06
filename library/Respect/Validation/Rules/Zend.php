<?php

namespace Respect\Validation\Rules;

use ReflectionClass;
use Respect\Validation\Validatable;
use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Exceptions\CallbackException;
use Respect\Validation\Exceptions\InvalidException;

class Zend extends AbstractRule implements Validatable
{

    protected $messages = array();
    protected $zendValidator;

    public function __construct($name, $params=array())
    {
        $zendMirror = new ReflectionClass('Zend\Validator\\' . ucfirst($name));
        $this->zendValidator = $zendMirror->newInstanceArgs($params);
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
                $exceptions[] = new InvalidException($m);
            }
            throw new InvalidException($exceptions);
        }
        return true;
    }

}