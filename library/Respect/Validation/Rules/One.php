<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\InvalidException;
use Respect\Validation\Validatable;

class One extends AbstractComposite implements Validatable
{

    public function assert($input)
    {
        $validators = $this->getRules();
        $exceptions = $this->iterateRules($input);
        if (count($exceptions) === count($validators))
            throw new InvalidException($exceptions);
        return true;
    }

    public function validate($input)
    {
        return (boolean) array_filter(
            $this->getRules(),
            function($v) use($input) {
                return $v->validate($input);
            }
        );
    }

}