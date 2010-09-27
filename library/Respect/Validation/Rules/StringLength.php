<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Exceptions\StringLengthException;
use Respect\Validation\Validatable;
use Respect\Validation\Validator;
use Respect\Validation\Exceptions\NotNumericException;
use Respect\Validation\Exceptions\ComponentException;

class StringLength extends AbstractRule implements Validatable
{
    const MSG_LENGTH_MIN = 'StringLength_1';
    const MSG_LENGTH_MAX = 'StringLength_2';

    protected $messages = array(
        self::MSG_LENGTH_MIN => '%s does not have at least %s characters',
        self::MSG_LENGTH_MAX => '%s exceeds the maximum of %s characters'
    );
    protected $min;
    protected $max;

    public function __construct($min=null, $max=null)
    {
        $this->min = $min;
        $this->max = $max;
        try {
            Validator::one(Validator::numeric($min), Validator::NullValue());
        } catch (NotNumericException $e) {
            throw new ComponentException(
                sprintf('%s is not a valid numeric length', $min)
            );
        }
        try {
            Validator::one(Validator::numeric($max), Validator::NullValue());
        } catch (NotNumericException $e) {
            throw new ComponentException(
                sprintf('%s is not a valid numeric length', $max)
            );
        }
    }

    public function validateMin($input)
    {
        return is_null($this->min) || mb_strlen($input) >= $this->min;
    }

    public function validateMax($input)
    {
        return is_null($this->max) || mb_strlen($input) <= $this->max;
    }

    public function validate($input)
    {
        return $this->validateMin($input) && $this->validateMax($input);
    }

    public function assert($input)
    {
        if (!$this->validateMin($input))
            throw new StringLengthException(
                sprintf($this->getMessage(self::MSG_LENGTH_MIN), $input, $this->min)
            );
        if (!$this->validateMax($input))
            throw new StringLengthException(
                sprintf($this->getMessage(self::MSG_LENGTH_MAX), $input, $this->max)
            );
        return true;
    }

}