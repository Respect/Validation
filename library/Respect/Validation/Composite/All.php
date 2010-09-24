<?php

namespace Respect\Validation\Composite;

use Respect\Validation\AbstractCompositeValidator;
use Respect\Validation\InvalidException;

class All extends AbstractCompositeValidator
{

    public function isValid($input)
    {
        $validators = $this->getValidators();
        return count($validators) === count(array_filter(
                $validators,
                function($v) use($input) {
                    return $v->isValid($input);
                }
            ));
    }

    public function validate($input)
    {
        $exceptions = $this->iterateValidation($input);
        if (!empty($exceptions))
            throw new InvalidException($exceptions);
        return true;
    }

    
}