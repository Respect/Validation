<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Graham Campbell <graham@mineuk.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Jayson Reis <santosdosreis@gmail.com>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 * SPDX-FileContributor: Renato Moura <renato@naturalweb.com.br>
 * SPDX-FileContributor: William Espindola <oi@williamespindola.com.br>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Validators\Core\Simple;

use function array_map;
use function array_sum;
use function count;
use function is_scalar;
use function ord;
use function preg_replace;
use function str_split;
use function strtoupper;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be a CNPJ',
    '{{subject}} must not be a CNPJ',
)]
final class Cnpj extends Simple
{
    private const int BASE_ASCII = 48;

    public function isValid(mixed $input): bool
    {
        if (!is_scalar($input)) {
            return false;
        }

        // Code ported from jsfromhell.com
        $bases = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
        $chars = $this->getChars((string) $input);
        $digits = $this->transformToAscii($chars);

        if (array_sum($digits) < 1) {
            return false;
        }

        if (count($digits) !== 14) {
            return false;
        }

        $n = 0;
        for ($i = 0; $i < 12; ++$i) {
            $n += $digits[$i] * $bases[$i + 1];
        }

        if ($digits[12] != (($n %= 11) < 2 ? 0 : 11 - $n)) {
            return false;
        }

        $n = 0;
        for ($i = 0; $i <= 12; ++$i) {
            $n += $digits[$i] * $bases[$i];
        }

        $check = ($n %= 11) < 2 ? 0 : 11 - $n;

        return $digits[13] == $check;
    }

    /** @return string[] */
    private function getChars(string $input): array
    {
        return str_split((string) preg_replace('/[\W_]/', '', strtoupper($input)));
    }

    /**
     * @param array<string> $input
     *
     * @return int[]
     */
    private function transformToAscii(array $input): array
    {
        return array_map(
            static fn(string $character) => ord($character) - self::BASE_ASCII,
            $input,
        );
    }
}
