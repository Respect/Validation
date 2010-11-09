<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\InvalidException;

class AllOf extends AbstractComposite
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
        $exceptions = $this->validateRules($input);
        if (!empty($exceptions))
            throw new InvalidException($exceptions);
        return true;
    }

    public function check($input)
    {
        foreach ($this->getRules() as $v)
            $v->assert($input);
    }

}