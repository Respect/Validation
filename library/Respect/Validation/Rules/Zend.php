<?php
namespace Respect\Validation\Rules;

use ReflectionClass;
use Respect\Validation\Exceptions\ComponentException;

class Zend extends AbstractRule
{
    protected $messages = array();
    protected $zendValidator;

    public function __construct($validator, $params=array())
    {
        if (is_object($validator)) {
            return $this->zendValidator = $validator;
        }

        if (!is_string($validator)) {
            throw new ComponentException('Invalid Validator Construct');
        }

        if (false === stripos($validator, 'Zend')) {
            $validator = "Zend\Validator\\{$validator}";
        } else {
            $validator = "\\{$validator}";
        }

        $zendMirror = new ReflectionClass($validator);

        if ($zendMirror->hasMethod('__construct')) {
            $this->zendValidator = $zendMirror->newInstanceArgs($params);
        } else {
            $this->zendValidator = $zendMirror->newInstance();
        }
    }

    public function assert($input)
    {
        $exceptions = array();
        $validator = clone $this->zendValidator;

        if ($validator->isValid($input)) {
            return true;
        } else {
            foreach ($validator->getMessages() as $m) {
                $exceptions[] = $this->reportError($m, get_object_vars($this));
            }
        }

        throw $this->reportError($input)->setRelated($exceptions);
    }

    public function validate($input)
    {
        $validator = clone $this->zendValidator;

        return $validator->isValid($input);
    }
}

