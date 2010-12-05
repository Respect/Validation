<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\BetweenException;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Exceptions\ValidationException;

class Between extends AllOf
{

    public function __construct($min=null, $max=null)
    {
        $this->min = $min;
        if (!is_null($min) && !is_null($max) && $min > $max)
            throw new ComponentException(
                sprintf(
                    '%s cannot be less than  %s for validation', $this->min,
                    $this->max
                )
            );
        if (!is_null($min))
            $this->addRule(new Min($min));
        if (!is_null($max))
            $this->addRule(new Max($max));
    }

    public function assert($input)
    {
        try {
            parent::assert($input);
        } catch (ValidationException $e) {
            throw $this->getException() ? : BetweenException::create()
                    ->addRelated($e)
                    ->configure($input);
        }
        return true;
    }

    public function check($input)
    {
        return $this->assert($input);
    }

}