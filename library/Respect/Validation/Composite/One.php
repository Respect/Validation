<?php

namespace Respect\Validation\Composite;

use Respect\Validation\AbstractCompositeValidator;
use Respect\Validation\InvalidException;

class One extends AbstractCompositeValidator
{

    public function assert($input)
    {
        $validators = $this->getValidators();
        $exceptions = $this->iterateValidation($input);
        if (count($exceptions) === count($validators))
            throw new InvalidException($exceptions);
        return true;
    }

    public function is($input)
    {
        return (boolean) array_filter(
            $this->getValidators(),
            function($v) use($input) {
                return $v->is($input);
            }
        );
    }

}