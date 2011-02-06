<?php

namespace Respect\Validation\Rules;

class AllOf extends AbstractComposite
{

    public function validate($input)
    {
        foreach ($this->getRules() as $rule)
            if (!$rule->validate())
                return false;
        return true;
    }

    public function assert($input)
    {
        $exceptions = $this->validateRules($input);
        $numRules = count($this->rules);
        if (!empty($exceptions))
            throw $this->reportError($input, $exceptions, count($exceptions),
                $numRules, $numRules);
        return true;
    }

    public function check($input)
    {
        foreach ($this->getRules() as $v)
            $v->check($input);
    }

}