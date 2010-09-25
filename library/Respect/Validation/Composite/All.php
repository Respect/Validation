<?php

namespace Respect\Validation\Composite;

use Respect\Validation\AbstractCompositeValidator;
use Respect\Validation\InvalidException;

class All extends AbstractCompositeValidator
{

    public function is($input)
    {
        $validators = $this->getValidators();
        return count($validators) === count(array_filter(
                $validators,
                function($v) use($input) {
                    return $v->is($input);
                }
            ));
    }

    public function assert($input)
    {
        $exceptions = $this->iterateValidation($input);
        if (!empty($exceptions))
            throw new InvalidException($exceptions);
        return true;
    }

}