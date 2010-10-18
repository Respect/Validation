<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\InvalidException;

class Most extends AbstractComposite
{

    public function assert($input)
    {
        $validators = $this->getRules();
        $exceptions = $this->validateRules($input);
        if ((count($validators) / 2) > (count($validators) - count($exceptions)))
            throw new InvalidException($exceptions);
        return true;
    }

    public function validate($input)
    {
        $validators = $this->getRules();
        $exceptions = $this->validateRules($input);
        return (count($validators) / 2) < (count($validators) - count($exceptions));
    }

}