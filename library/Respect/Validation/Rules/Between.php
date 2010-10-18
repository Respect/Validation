<?php

namespace Respect\Validation\Rules;

use \Exception;
use Respect\Validation\Validator;
use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Exceptions\NotBetweenException;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Validatable;

class Between extends AbstractRule
{

    protected $min;
    protected $max;
    protected $type;
    const MSG_LESS = 'Between_1';
    const MSG_MORE = 'Between_2';
    protected $messageTemplates = array(
        self::MSG_LESS => '%s is less than the specified minimum of %s',
        self::MSG_MORE => '%s is more than the specified maximum of %s',
    );

    public function __construct($min=null, $max=null, Validatable $type=null)
    {
        $this->min = $min;
        $this->max = $max;
        $this->type = $type;
        if (!is_null($min) && !is_null($max) && $min > $max)
            throw new ComponentException(
                sprintf(
                    '%s cannot be less than  %s for validation', $this->min,
                    $this->max
                )
            );
        if (is_null($type))
            return;
        try {
            $type->assert($min);
            $type->assert($max);
        } catch (Exception $e) {
            throw new ComponentException(
                $e->getMessage()
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
        return (is_null($this->type) || $this->type->validate($input))
        && $this->validateMin($input)
        && $this->validateMax($input);
    }

    public function assert($input)
    {
        if (!is_null($this->type))
            $this->type->assert($input);
        if (!$this->validateMin($input))
            throw new NotBetweenException(
                sprintf(
                    $this->getMessageTemplate(self::MSG_LESS),
                    $this->getStringRepresentation($input),
                    $this->getStringRepresentation($this->min)
                )
            );
        if (!$this->validateMax($input))
            throw new NotBetweenException(
                sprintf(
                    $this->getMessageTemplate(self::MSG_MORE),
                    $this->getStringRepresentation($input),
                    $this->getStringRepresentation($this->max)
                )
            );
        return true;
    }

}