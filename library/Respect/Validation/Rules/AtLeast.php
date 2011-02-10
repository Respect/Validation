<?php

namespace Respect\Validation\Rules;

class AtLeast extends AbstractComposite
{

    public $howMany = 1;

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
        $numPassed = $numRules - $numExceptions;
        $summary = array(
            'total' => $numRules,
            'failed' => $numExceptions,
            'passed' => $numPassed
        );
        if ($this->howMany > $numPassed)
            throw $this->reportError($input, $summary)->setRelated($exceptions);
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
            if (count($exceptions) > ($numPassed = count($validators) - $this->howMany))
                throw $this->reportError($input, array('passed' => $numPassed))
                    ->setRelated($exceptions);
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
