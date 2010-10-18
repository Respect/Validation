<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\InvalidException;

class AtLeast extends AbstractComposite 
{

    protected $howMany = 1;

    public function __construct($howMany, $rules=array())
    {
        $this->howMany = $howMany;
        call_user_func_array(array($this, 'parent::__construct'), $rules);
    }

    public function assert($input)
    {
        $validators = $this->getRules();
        $exceptions = $this->validateRules($input);
        if ($this->howMany > (count($validators) - count($exceptions)))
            throw new InvalidException($exceptions);
        return true;
    }

    public function validate($input)
    {
        $validators = $this->getRules();
        $exceptions = $this->validateRules($input);
        return $this->howMany <= (count($validators) - count($exceptions));
    }

}