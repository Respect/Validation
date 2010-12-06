<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\AllOfException;

class AllOf extends AbstractComposite
{

    public function validate($input)
    {
        $validators = $this->getRules();
        $passedValidators = array_filter(
            $validators,
            function($v) use($input) {
                return $v->validate($input);
            }
        );
        return count($validators) === count($passedValidators);
    }

    public function assert($input)
    {
        $exceptions = $this->validateRules($input);
        $numRules = count($this->rules);
        if (!empty($exceptions))
            throw $this->getException() ? : $this->createException()
                    ->setRelated($exceptions)
                    ->configure(
                        $input, count($exceptions), $numRules, $numRules
                    );
        return true;
    }

    public function check($input)
    {
        foreach ($this->getRules() as $v)
            $v->check($input);
    }

}