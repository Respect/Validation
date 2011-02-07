<?php

namespace Respect\Validation\Rules;

class AtLeast extends AbstractComposite
{

    protected $howMany = 1;

    public function __construct($howMany, $rules=array())
    {
        $this->howMany = $howMany;
        $this->addRules($rules);
    }

    public function assert($input)
    {
        $validators = $this->getRules();
        $exceptions = $this->validateRules($input);
        $numRules = count($validators);
        $numExceptions = count($exceptions);
        if ($this->howMany > ($numRules - $numExceptions))
            throw $this->reportError($input, $exceptions, $numExceptions,
                $this->howMany, $numRules);
        return true;
    }

    public function check($input)
    {
        $validators = $this->getRules();
        $pass = 0;
        $exceptions = array();
        foreach ($validators as $v) {
            try {
                $v->check($input);
                $pass++;
            } catch (ValidationException $e) {
                $exceptions[] = $e;
            }
            if ($pass >= $this->howMany)
                return true;
            if (count($exceptions) > (count($validators) - $this->howMany))
                throw $this->reportError($input, $exceptions,
                    count($exceptions), $this->howMany);
        }
        return false;
    }

    public function validate($input)
    {
        $validators = $this->getRules();
        $pass = 0;
        foreach ($validators as $v) {
            try {
                $v->check($input);
                $pass++;
            } catch (ValidationException $e) {
                //no need to do anything here. We just wanna count 
                //how many rules passed
            }
            if ($pass >= $this->howMany)
                return true;
        }
        return false;
    }

}