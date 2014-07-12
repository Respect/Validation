<?php
namespace Respect\Validation\Rules;

class NoneOf extends AbstractComposite
{
    public function assert($input)
    {
        $exceptions = $this->validateRules($input);
        $numRules = count($this->getRules());
        $numExceptions = count($exceptions);
        if ($numRules !== $numExceptions) {
            throw $this->reportError($input)->setRelated($exceptions);
        }

        return true;
    }

    public function validate($input)
    {
        foreach ($this->getRules() as $rule) {
            if ($rule->validate($input)) {
                return false;
            }

        }
        return true;
    }
}

