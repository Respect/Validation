<?php
namespace Respect\Validation\Rules;

class AllOf extends AbstractComposite
{
    public function assert($input)
    {
        $exceptions = $this->validateRules($input);
        $numRules = count($this->rules);
        $numExceptions = count($exceptions);
        $summary = array(
            'total' => $numRules,
            'failed' => $numExceptions,
            'passed' => $numRules - $numExceptions
        );
        if (!empty($exceptions)) {
            throw $this->reportError($input, $summary)->setRelated($exceptions);
        }

        return true;
    }

    public function check($input)
    {
        foreach ($this->getRules() as $v) {
            if (!$v->check($input)) {
                return false;
            }
        }

        return true;
    }

    public function validate($input)
    {
        foreach ($this->getRules() as $v) {
            if (!$v->validate($input)) {
                return false;
            }
        }

        return true;
    }
}

