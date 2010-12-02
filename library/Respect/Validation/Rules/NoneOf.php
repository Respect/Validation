<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\NoneOfException;

class NoneOf extends AbstractComposite
{
    public function createException()
    {
        return new NoneOfException;
    }

    public function validate($input)
    {
        $validators = $this->getRules();
        return count($validators) === count(array_filter(
                $validators,
                function($v) use($input) {
                    return!$v->validate($input);
                }
            ));
    }

    public function assert($input)
    {
        $exceptions = $this->validateRules($input);
        if (count($this->getRules()) !== count($exceptions))
            throw $this
                ->getException()
                ->setRelated($exceptions);
        return true;
    }

    public function check($input)
    {
        return $this->assert($input);
    }

}