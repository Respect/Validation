<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Validator;
use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Exceptions\BetweenException;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Validatable;
use Respect\Validation\Exceptions\ValidationException;

class Between extends AbstractRule
{

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
        } catch (ValidationException $e) {
            throw new ComponentException(
                $e->getMessage()
            );
        }
    }

    public function createException()
    {
        return new BetweenException;
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
        $exceptions = array();
        if (!$this->validateMin($input))
            $exceptions[] = $this
                ->createException()
                ->setMessageTemplateFromCode(BetweenException::INVALID_LESS)
                ->setParams($input, $this->min);
        if (!$this->validateMax($input))
            $exceptions[] = $this
                ->createException()
                ->setMessageTemplateFromCode(BetweenException::INVALID_MORE)
                ->setParams($input, $this->max);
        if (!empty($exceptions))
            throw $this
                ->createException()
                ->setMessageTemplateFromCode(BetweenException::INVALID_BOUNDS)
                ->setParams($input)
                ->setRelated($exceptions);
        return true;
    }

    public function check($input)
    {
        return $this->assert($input);
    }

}