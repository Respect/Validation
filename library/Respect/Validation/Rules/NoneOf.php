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
        $numRules = count($this->getRules());
        $numExceptions = count($exceptions);
        if ($numRules !== $numExceptions)
            throw $this
                ->getException()
                ->configure($input, $numRules, $numExceptions)
                ->setRelated($exceptions);
        return true;
    }

    public function check($input)
    {
        return $this->assert($input);
    }

}