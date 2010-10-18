<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\InvalidException;

class One extends AbstractComposite
{

    public function assert($input)
    {
        $validators = $this->getRules();
        $exceptions = $this->validateRules($input);
        if (count($exceptions) === count($validators))
            throw new InvalidException($exceptions);
        return true;
    }

    public function validate($input)
    {
        foreach ($this->getRules() as $v)
            if ($v->validate($input))
                return true;
        return false;
    }

    public function check($input)
    {
        return $this->assert($input);
    }

}