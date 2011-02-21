<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Validatable;
use Respect\Validation\Exceptions\ValidationException;

class Not extends AbstractRule
{

    public $rule;

    public function __construct(Validatable $rule)
    {
        $this->rule = $rule;
    }

    public function validate($input)
    {
        return!$this->rule->validate($input);
    }

    public function assert($input)
    {
        try {
            $this->rule->assert($input);
        } catch (ValidationException $e) {
            return true;
        }
        $e = $this->rule->reportError($input);
        //TODO very very very nasty hack. Need to think of a better solution
        $e->setTemplate(str_replace('must', 'must not', $e->getTemplate()));
        throw $e;
    }

    public function check($input)
    {
        try {
            $this->rule->check($input);
        } catch (ValidationException $e) {
            return true;
        }
        $e = $this->rule->reportError($input);
        //TODO very very very nasty hack. Need to think of a better solution
        $e->setTemplate(str_replace('must', 'must not', $e->getTemplate()));
        throw $e;
    }

}