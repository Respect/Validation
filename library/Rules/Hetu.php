<?php

/*
 * Copyright (c) Ville Hukkamäki <vhukkamaki@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Message\Template;
use Respect\Validation\Rules\Core\Simple;

use function is_string;
use function preg_match;
use function strtoupper;

/**
 * @see https://en.wikipedia.org/wiki/National_identification_number#Finland
 */
#[Template(
    '{{name}} must be a valid Finnish personal identity code',
    '{{name}} must not be a valid Finnish personal identity code',
)]
final class Hetu extends Simple
{
    public function validate(mixed $input): bool
    {
        if (!is_string($input)) {
            return false;
        }

        $input = strtoupper($input);

        if (!preg_match('/^(\d{2})(\d{2})(\d{2})([+\-A-FU-Y])(\d{3})([0-9A-FHJ-NPR-Y])$/', $input, $m)) {
            return false;
        }

        $century = match ($m[4]) {
            '+' => '18',
            '-','U','V','W','X','Y' => '19',
            'A','B','C','D','E','F' => '20',
        };

        $dateRule = new Date();
        if (!$dateRule->evaluate($century . $m[3] . '-' . $m[2] . '-' . $m[1])->isValid) {
            return false;
        }

        return $this->getChecksum($m[1] . $m[2] . $m[3] . $m[5]) === $m[6];
    }

    private function getChecksum(string $s): string
    {
        $mod = (int)$s % 31;
        $tab = [
            '0','1','2','3','4','5','6','7','8','9','A','B','C','D','E','F','H','J','K','L','M','N','P',
            'R','S','T','U','C','W','X','Y',
        ];

        return $tab[$mod];
    }
}
