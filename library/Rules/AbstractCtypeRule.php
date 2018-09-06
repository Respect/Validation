<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

abstract class AbstractCtypeRule extends AbstractFilterRule
{
    abstract protected function ctypeFunction($input);

    public function validateClean($input)
    {
        return $this->ctypeFunction($input);
    }
}
