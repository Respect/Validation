<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Validator;
use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Rules\Numeric;
use Respect\Validation\Exceptions\NotNumericException;
use Respect\Validation\Exceptions\NumberOutOfBoundsException;

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
    
    public function __construct($min, $max = null)
    {
        $this->min = $min;
        $this->max = $max;
        $nullValue = Validator::NullValue();
        try {
            Validator::one(Validator::numeric($min), $nullValue);
        } catch (NotNumericException $e) {
            throw new NotNumericException(sprintf(Numeric::getMessage(Numeric::MSG_NOT_NUMERIC), $min));
        }
        if ( is_null($max) ) {
            return;
        }
        try {
            Validator::one(Validator::numeric($max), $nullValue);
        } catch (NotNumericException $e) {
            throw new NotNumericException(sprintf(Numeric::getMessage(Numeric::MSG_NOT_NUMERIC), $max));
        }
        if ( $this->min > $this->max ) {
            throw new ComponentException(
                sprintf('%s cannot be less than  %s for validation',
                    $this->$min, $this->max)
            );
        }
    }

    public function validate($input)
    {
        try {
            Validator::numeric($input);
            $max = ( is_null($this->max) ) ? $input : $this->max;
        } catch (Exception $e) {
            return false;
        }
        return $input >= $this->min && $input <= $this->max;
    }

    public function assert($input)
    {
        if ( $this->validate($input) ) {
            return true;
        }
        
        Validator::numeric($input);
        
        if ( $input < $this->min ) {
            throw new NumberOutOfBoundsException(
                sprintf($this->getMessageTemplate(self::MSG_NUMBER_LESS), $input, $this->min)
            );
        }
        if ( ! is_null($this->max) && $input > $this->max ) {
            throw new NumberOutOfBoundsException(
                sprintf($this->getMessageTemplate(self::MSG_NUMBER_MORE), $input, $this->max)
            );
        }
        return true;
    }

}