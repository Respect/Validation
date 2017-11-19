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

namespace Respect\Validation\Exceptions;

class AtLeastException extends GroupedValidationException
{
    public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::NONE => 'At least {{howMany}} of the {{failed}} required rules must pass for {{name}}',
            self::SOME => 'At least {{howMany}} of the {{failed}} required rules must pass for {{name}}, only {{passed}} passed.',
        ],
        self::MODE_NEGATIVE => [
            self::NONE => 'At least {{howMany}} of the {{failed}} required rules must not pass for {{name}}',
            self::SOME => 'At least {{howMany}} of the {{failed}} required rules must not pass for {{name}}, only {{passed}} passed.',
        ],
    ];
}
