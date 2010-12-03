<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\AllOfException;

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
            throw $this->getException() ? : AllOfException::create()
                    ->setRelated($exceptions)
                    ->configure(
                        $input, count($exceptions), count($this->rules)
                    );
        return true;
    }

    public function check($input)
    {
        foreach ($this->getRules() as $v)
            $v->check($input);
    }

}