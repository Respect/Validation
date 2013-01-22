<?php
namespace Respect\Validation\Rules;

use Respect\Validation\Validatable;
use Respect\Validation\Exceptions\ValidationException;

class Not extends AbstractRule
{
    public $rule;

    public function __construct(Validatable $rule)
    {
        if ($rule instanceof AbstractComposite) {
            $rule = $this->absorbComposite($rule);
        }

        $this->rule = $rule;
    }

    public function validate($input)
    {
        if ($this->rule instanceof AbstractComposite) {
            return $this->rule->validate($input);
        }

        return!$this->rule->validate($input);
    }

    public function assert($input)
    {
        if ($this->rule instanceof AbstractComposite) {
            return $this->rule->assert($input);
        }

        try {
            $this->rule->assert($input);
        } catch (ValidationException $e) {
            return true;
        }

        throw $this->rule
            ->reportError($input)
            ->setMode(ValidationException::MODE_NEGATIVE);
    }

    protected function absorbComposite(AbstractComposite $rule)
    {
        $clone = clone $rule;
        $rules = $clone->getRules();
        $clone->removeRules();

        foreach ($rules as &$r) {
            if ($r instanceof AbstractComposite) {
                $clone->addRule($this->absorbComposite($r));
            } else {
                $clone->addRule(new static($r));
            }
        }

        return $clone;
    }
}

