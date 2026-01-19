<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Ville Hukkamäki <vhukkamaki@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Validation\Helpers\CanValidateDateTime;
use Respect\Validation\Message\Template;
use Respect\Validation\Validators\Core\Simple;

use function is_string;
use function preg_match;
use function str_split;

/** @see https://en.wikipedia.org/wiki/National_identification_number#Finland */
#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be a valid Finnish personal identity code',
    '{{subject}} must not be a valid Finnish personal identity code',
)]
final class Hetu extends Simple
{
    use CanValidateDateTime;

    public function isValid(mixed $input): bool
    {
        if (!is_string($input)) {
            return false;
        }

        if (!preg_match('/^(\d{2})(\d{2})(\d{2})([+\-A-FU-Y])(\d{3})([0-9A-FHJ-NPR-Y])$/', $input, $matches)) {
            return false;
        }

        [, $day, $month, $year, $centuryMarker, $individualNumber, $controlCharacter] = $matches;

        // @phpstan-ignore-next-line
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
