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

/**
 * Validates Spain's fiscal identification number (NIF).
 *
 * @author Julián Gutiérrez <juliangut@gmail.com>
 *
 * @see https://es.wikipedia.org/wiki/N%C3%BAmero_de_identificaci%C3%B3n_fiscal
 */
final class Nif extends AbstractRule
{
    /**
     * {@inheritdoc}
     */
    public function validate($input)
    {
        if (!is_string($input)) {
            return false;
        }

        if (preg_match('/^(\d{8})([A-Z])$/', $input, $matches)) {
            return $this->validateDni($matches[1], $matches[2]);
        }

        if (preg_match('/^([KLMXYZ])(\d{7})([A-Z])$/', $input, $matches)) {
            return $this->validateNie($matches[1], $matches[2], $matches[3]);
        }

        if (preg_match('/^([A-HJNP-SUVW])(\d{7})([0-9A-Z])$/', $input, $matches)) {
            return $this->validateCif($matches[2], $matches[3]);
        }

        return false;
    }

    /**
     * @param int $number
     * @param int $control
     */
    private function validateDni($number, $control)
    {
        return mb_substr('TRWAGMYFPDXBNJZSQVHLCKE', ($number % 23), 1) === $control;
    }

    /**
     * @param string $prefix
     * @param int    $number
     * @param int    $control
     */
    private function validateNie($prefix, $number, $control)
    {
        if ('Y' === $prefix) {
            return $this->validateDni('1'.$number, $control);
        }

        if ('Z' === $prefix) {
            return $this->validateDni('2'.$number, $control);
        }

        return $this->validateDni($number, $control);
    }

    /**
     * @param int    $number
     * @param string $control
     */
    private function validateCif(string $number, $control)
    {
        $code = 0;
        $position = 1;
        foreach (str_split($number) as $digit) {
            $increaser = $digit;
            if (0 !== $position % 2) {
                $increaser = array_sum(str_split((string) ($digit * 2)));
            }

            $code += $increaser;
            ++$position;
        }

        $digits = str_split((string) $code);
        $lastDigit = (int) array_pop($digits);
        $key = 0 === $lastDigit ? 0 : (10 - $lastDigit);

        if (is_numeric($control)) {
            return (int) $key === (int) $control;
        }

        return mb_substr('JABCDEFGHI', ($key % 10), 1) === $control;
    }
}
