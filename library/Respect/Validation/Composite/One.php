<?php

namespace Respect\Validation\Composite;

use Respect\Validation\AbstractCompositeRule;
use Respect\Validation\InvalidException;

class One extends AbstractCompositeRule
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