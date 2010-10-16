<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Validator;
use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Rules\Numeric;
use Respect\Validation\Exceptions\NotNumericException;
use Respect\Validation\Exceptions\NumberOutOfBoundsException;
use Respect\Validation\Exceptions\InvalidException;
use Respect\Validation\Exceptions\ComponentException;

class NumericBetween extends AbstractRule
{

    protected $min;
    protected $max;
    const MSG_NUMBER_LESS = 'NumberBetween_1';
    const MSG_NUMBER_MORE = 'NumberBetween_2';
    protected $messageTemplates = array(
        self::MSG_NUMBER_LESS => '%s is less than the specified minimum (%s)',
        self::MSG_NUMBER_MORE => '%s is more than the specified maximum (%s)',
    );

    public function __construct($min=null, $max=null)
    {
        $this->min = $min;
        $this->max = $max;
        $paramValidator = Validator::one(
                Validator::numeric(), Validator::nullValue()
        );
        if (!$paramValidator->validate($min))
            throw new ComponentException(
                sprintf('%s is not a valid numeric length', $min)
            );

        if (!$paramValidator->validate($max))
            throw new ComponentException(
                sprintf('%s is not a valid numeric length', $max)
            );

        if (!is_null($min) && !is_null($max) && $min > $max) {
            throw new ComponentException(
                sprintf('%s cannot be less than  %s for validation', $this->min,
                    $this->max)
            );
        }
    }

    public function validateMin($input)
    {
        return is_null($this->min) || $input >= $this->min;
    }

    public function validateMax($input)
    {
        return is_null($this->max) || $input <= $this->max;
    }

    public function validate($input)
    {
        return Validator::numeric($input)->validate($input)
        && $this->validateMin($input)
        && $this->validateMax($input);
    }

    public function assert($input)
    {
        $validNumeric = new Numeric();
        $validNumeric->assert($input);
        if (!$this->validateMin($input))
            throw new NumberOutOfBoundsException(
                sprintf($this->getMessageTemplate(self::MSG_NUMBER_LESS),
                    $input, $this->min)
            );
        if (!$this->validateMax($input))
            throw new NumberOutOfBoundsException(
                sprintf($this->getMessageTemplate(self::MSG_NUMBER_MORE),
                    $input, $this->max)
            );
        return true;
    }

}