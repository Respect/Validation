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

class Nullable extends AbstractWrapper
{
    public function __construct(Validatable $rule)
    {
        $this->validatable = $rule;
    }

    public function assert($input)
    {
        if ($input === null) {
            return true;
        }

        return parent::assert($input);
    }

    public function check($input)
    {
        if ($input === null) {
            return true;
        }

        return parent::check($input);
    }

    public function validate($input)
    {
        if ($input === null) {
            return true;
        }

        return parent::validate($input);
    }
}
