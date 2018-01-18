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

use Respect\Validation\Helpers\UndefinedHelper;
use Respect\Validation\Validatable;

class Optional extends AbstractWrapper
{
    use UndefinedHelper;

    public function __construct(Validatable $rule)
    {
        $this->validatable = $rule;
    }

    public function assert($input)
    {
        if ($this->isUndefined($input)) {
            return true;
        }

        return parent::assert($input);
    }

    public function check($input)
    {
        if ($this->isUndefined($input)) {
            return true;
        }

        return parent::check($input);
    }

    public function validate($input)
    {
        if ($this->isUndefined($input)) {
            return true;
        }

        return parent::validate($input);
    }
}
