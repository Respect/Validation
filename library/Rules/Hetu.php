<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Helpers\CanValidateDateTime;

use function is_string;
use function preg_match;
use function str_split;

/**
 * Validates whether the input is a valid Finnish personal identity code (henkilötunnus).
 *
 * @see https://en.wikipedia.org/wiki/National_identification_number#Finland
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Ville Hukkamäki <vhukkamaki@gmail.com>
 */
final class Hetu extends AbstractRule
{
    use CanValidateDateTime;

    /**
     * @deprecated Calling `validate()` directly from rules is deprecated. Please use {@see \Respect\Validation\Validator::isValid()} instead.
     */
    public function validate($input): bool
    {
        if (!is_string($input)) {
            return false;
        }

        if (!preg_match('/^(\d{2})(\d{2})(\d{2})([+\-A-FU-Y])(\d{3})([0-9A-FHJ-NPR-Y])$/', $input, $matches)) {
            return false;
        }

        [, $day, $month, $year, $centuryMarker, $individualNumber, $controlCharacter] = $matches;

        // @phpstan-ignore-next-line the regular expression guarantees a valid century marker
        $century = match ($centuryMarker) {
            '+' => '18',
            '-', 'U', 'V', 'W', 'X', 'Y' => '19',
            'A', 'B', 'C', 'D', 'E', 'F' => '20',
        };
        if (!$this->isDateTime('dmY', $day . $month . $century . $year)) {
            return false;
        }

        $id = (int) ($day . $month . $year . $individualNumber);
        $validationKeys = str_split('0123456789ABCDEFHJKLMNPRSTUVWXY');

        return $validationKeys[$id % 31] === $controlCharacter;
    }
}
