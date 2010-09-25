<?php

namespace Respect\Validation\Composite;

use Respect\Validation\AbstractCompositeRule;
use Respect\Validation\InvalidException;

class All extends AbstractCompositeRule
{

    public function validate($input)
    {
        $validators = $this->getRules();
        return count($validators) === count(array_filter(
                $validators,
                function($v) use($input) {
                    return $v->validate($input);
                }
            ));
    }

    public function assert($input)
    {
        $exceptions = $this->iterateRules($input);
        if (!empty($exceptions))
            throw new InvalidException($exceptions);
        return true;
    }

}