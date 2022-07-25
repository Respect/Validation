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

class NoneOf extends AbstractComposite
{
    public function assert($input)
    {
        if ($this->validate($input)) {
            return true;
        }

        throw $this
            ->reportError($input)
            ->setRelated($this->validateRules($input));
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
