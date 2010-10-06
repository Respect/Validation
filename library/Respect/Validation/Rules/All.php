<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\InvalidException;

class All extends AbstractComposite
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