<?php

namespace Respect\Validation\Rules;

use ReflectionClass;
use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Exceptions\CallbackException;
use Respect\Validation\Exceptions\InvalidException;
use Symfony\Component\Validator\ConstraintViolation;

class Sf extends AbstractRule
{

    protected $messages = array();
    protected $constraint;
    protected $validator;
    protected $name;

    public function __construct($name, $params=array())
    {
        $this->name = ucfirst($name);
        $sfMirrorConstraint = new ReflectionClass(
                'Symfony\Component\Validator\Constraints\\' . $this->name
        );
        if ($sfMirrorConstraint->hasMethod('__construct'))
            $this->constraint = $sfMirrorConstraint->newInstanceArgs($params);
        else
            $this->constraint = $sfMirrorConstraint->newInstance();
    }

    public function validate($input)
    {
        $validatorName = 'Symfony\Component\Validator\Constraints\\'
            . $this->name . 'Validator';
        $this->validator = new $validatorName;
        return $this->validator->isValid($input, $this->constraint);
    }

    public function assert($input)
    {
        if (!$this->validate($input)) {
            $violation = new ConstraintViolation(
                    $this->validator->getMessageTemplate(),
                    $this->validator->getMessageParameters(),
                    '',
                    '',
                    $input
            );
            throw new InvalidException($violation->getMessage());
        }
        return true;
    }

}