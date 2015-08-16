<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Rules;

use Respect\Validation\Validatable;
use Respect\Validation\Exceptions\ValidationException;

class Not extends AbstractRule
{
    public $rule;

    public function __construct(Validatable $rule)
    {
        if ($rule instanceof AllOff) {
            $rule = $this->absorbComposite($rule);
        }

        $this->rule = $rule;
    }

    protected function validateConcrete($input)
    {
        if ($this->rule instanceof AllOff) {
            return $this->rule->validate($input);
        }

        return!$this->rule->validate($input);
    }

    public function assert($input)
    {
        if ($this->rule instanceof AllOff) {
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

    protected function absorbComposite(AbstractComposite $compositeRule)
    {
        if (!$compositeRule instanceof AllOff) {
            return $compositeRule;
        }

        $compositeRuleClone = clone $compositeRule;
        $compositeRuleClone->removeRules();

        foreach ($compositeRule->getRules() as $rule) {
            if ($rule instanceof AbstractComposite) {
                $compositeRuleClone->addRule($this->absorbComposite($rule));
            } else {
                $compositeRuleClone->addRule(new static($rule));
            }
        }

        return $compositeRuleClone;
    }
}
