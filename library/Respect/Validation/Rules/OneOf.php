<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\OneOfException;

class OneOf extends AbstractComposite
{

    public function createException()
    {
        return new OneOfException(OneOfException::INVALID_ONE_OF);
    }

    public function assert($input)
    {
        $validators = $this->getRules();
        $exceptions = $this->validateRules($input);
        if (count($exceptions) === count($validators))
            throw $this
                ->getException()
                ->configure(count($validators))
                ->setRelated($exceptions);
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