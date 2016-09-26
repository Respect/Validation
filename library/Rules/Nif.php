<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Rules;

/**
 * Validates Spain's fiscal identification number (NIF).
 *
 * @author Julián Gutiérrez <juliangut@gmail.com>
 *
 * @see https://es.wikipedia.org/wiki/N%C3%BAmero_de_identificaci%C3%B3n_fiscal
 */
class Nif extends AbstractRule
{
    /**
     * NIE key values.
     *
     * @var array
     */
    protected static $nieKeyValues = [
        'K' => '',
        'L' => '',
        'M' => '',
        'X' => '0',
        'Y' => '1',
        'Z' => '2'
    ];

    /**
     * {@inheritdoc}
     */
    public function validate($input)
    {
        if (preg_match('/^(\d{8})([A-Z])$/', $input, $matches)) {
            // DNI
            $code = (int) $matches[1];
            $control = $matches[2];

            return substr('TRWAGMYFPDXBNJZSQVHLCKE', $code % 23, 1) === $control;
        } elseif (preg_match('/^([KLMXYZ])(\d{7})([A-Z])$/', $input, $matches)) {
            // NIE
            $code = (int) (static::$nieKeyValues[$matches[1]] . $matches[2]);
            $control = $matches[3];

            return substr('TRWAGMYFPDXBNJZSQVHLCKE', $code % 23, 1) === $control;
        } elseif (preg_match('/^([ABCDEFGHJNPQRSUVW])(\d{7})([0-9A-Z])$/', $input, $matches)) {
            // CIF
            $control = $matches[3];

            $code = 0;
            $codeParts = str_split($matches[2]);
            array_walk(
                $codeParts,
                function ($value, $key) use (&$code) {
                    if (($key + 1) % 2 === 0) {
                        $code += $value;
                    } else {
                        $code += array_sum(str_split($value * 2));
                    }
                }
            );
            $controlKey = end(str_split($code));
            if ($controlKey !== 0) {
                $controlKey = 10 - $controlKey;
            }

            if (is_numeric($control)) {
                return $controlKey === (int) $control;
            }

            return substr('JABCDEFGHI', $controlKey % 10, 1) === $control;
        }

        return false;
    }
}
