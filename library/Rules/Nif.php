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
            $pos = 1;
            foreach (str_split($matches[2]) as $number) {
                if ($pos % 2 === 0) {
                    $code += $number;
                } else {
                    $code += array_sum(str_split($number * 2));
                }

                $pos++;
            }
            $code = str_split($code);
            $key = end($code) === 0 ? 0 : 10 - end($code);

            if (is_numeric($control)) {
                return (int) $key === (int) $control;
            }

            return substr('JABCDEFGHI', $key % 10, 1) === $control;
        }

        return false;
    }
}
