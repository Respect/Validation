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
        $exceptions = array();
        $numRules = count($validators);
        $numPassed = 0;
        $maxExceptions = $numRules - $this->howMany;
        foreach ($validators as $v) {
            try {
                $v->check($input);
                if (++$numPassed >= $this->howMany)
                    return true;
                if (count($exceptions) > $maxExceptions)
                    throw $this->reportError(
                        $input,
                        array('passed' => $numPassed))->setRelated($exceptions);
            } catch (ValidationException $e) {
                $exceptions[] = $e;
            }
        }
        return false;
    }

    public function validate($input)
    {
        $validators = $this->getRules();
        $numPassed = 0;
        foreach ($validators as $v)
            try {
                $v->check($input);
                if (++$numPassed >= $this->howMany)
                    return true;
            } catch (ValidationException $e) {
                //empty catch block is nasty, i know, but no need to do
                //anything here. We just wanna count how many rules passed
            }

        return false;
    }

}
