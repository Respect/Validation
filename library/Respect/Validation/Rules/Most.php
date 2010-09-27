<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\InvalidException;
use Respect\Validation\Validatable;

class Most extends AbstractComposite implements Validatable
{

    public function assert($input)
    {
        $validators = $this->getRules();
        $exceptions = $this->iterateRules($input);
        if ((count($validators) / 2) > (count($validators) - count($exceptions)))
            throw new InvalidException($exceptions);
        return true;
    }

    public function validate($input)
    {
        $validators = $this->getRules();
        $exceptions = $this->iterateRules($input);
        return (count($validators) / 2) < (count($validators) - count($exceptions));
    }

}