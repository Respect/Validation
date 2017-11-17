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

namespace Respect\Validation\Test\Rules;

use Respect\Validation\Result;
use Respect\Validation\Rule;

final class Equals implements Rule
{
    /**
     * {@inheritdoc}
     */
    public function apply($input): Result
    {
        // The content of this method is not important
    }
}
