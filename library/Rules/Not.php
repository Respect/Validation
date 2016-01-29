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

use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validatable;

class Not extends AbstractRule
{
    public $rule;

    public function __construct(Validatable $rule)
    {
        $this->rule = $rule;
    }

    public function setName($name)
    {
        $this->rule->setName($name);

        return parent::setName($name);
    }

    public function validate($input)
    {
        return (false == $this->rule->validate($input));
    }

    public function assert($input)
    {
        if ($this->validate($input)) {
            return true;
        }

        $rule = $this->rule;
        if ($rule instanceof AllOf) {
            $rule = $this->absorbAllOf($rule, $input);
        }

        throw $rule
            ->reportError($input)
            ->setMode(ValidationException::MODE_NEGATIVE);
    }

    private function absorbAllOf(AllOf $rule, $input)
    {
        $rules = $rule->getRules();
        while (($current = array_shift($rules))) {
            $rule = $current;
            if (!$rule instanceof AllOf) {
                continue;
            }

            if (!$rule->validate($input)) {
                continue;
            }

            $rules = $rule->getRules();
        }

        return $rule;
    }
}
