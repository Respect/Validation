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

class NotOptional extends AbstractRule
{
    use UndefinedHelper;

    public function validate($input)
    {
        return false === $this->isUndefined($input);
    }
}
