<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Validators\Core\Simple;

use function is_string;
use function preg_match;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be an emoji',
    '{{subject}} must not be an emoji',
)]
final class Emoji extends Simple
{
    private const string REGEX = <<<'REGEX'
        (?:
            # Tag sequence for country flags
            [\x{1F1E6}-\x{1F1FF}]{2}
            |
            # Tag sequence for subdivision flags
            \x{1F3F4}[\x{E0020}-\x{E007E}]+\x{E007F}
            |
            # Keycap sequences
            [0-9#*](?:\x{FE0F})?\x{20E3}
            |
            # Standard emoji cluster:
            \p{Extended_Pictographic}               # base emoji
            (?:\x{FE0F})?                           # optional emoji variant selector
            (?:[\x{1F3FB}-\x{1F3FF}])?              # optional skin tone modifier
            (?:                                     # optionally repeat ZWJ sequences:
                \x{200D}                            #   ZWJ
                (?:                                 #   joined element:
                    \p{Extended_Pictographic}       #     another emoji
                    |
                    [\x{2640}\x{2642}\x{26A7}]      #     or gender symbol
                )
                (?:\x{FE0F})?                       #   optional variant selector
                (?:[\x{1F3FB}-\x{1F3FF}])?          #   optional skin tone modifier
            )*                                      # ...zero or more times
        )
        REGEX;

    public function isValid(mixed $input): bool
    {
        if (!is_string($input)) {
            return false;
        }

        return preg_match('/^' . self::REGEX . '+$/ux', $input) === 1;
    }
}
