<?php

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Rules\Core\Simple;

use function array_pop;
use function array_sum;
use function is_numeric;
use function is_string;
use function mb_substr;
use function preg_match;
use function str_split;

/** @see https://es.wikipedia.org/wiki/N%C3%BAmero_de_identificaci%C3%B3n_fiscal */
#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be a valid NIF',
    '{{subject}} must not be a valid NIF',
)]
final class Nif extends Simple
{
    public function isValid(mixed $input): bool
    {
        if (!is_string($input)) {
            return false;
        }

        if (preg_match('/^(\d{8})([A-Z])$/', $input, $matches)) {
            return $this->validateDni((int) $matches[1], $matches[2]);
        }

        if (preg_match('/^([KLMXYZ])(\d{7})([A-Z])$/', $input, $matches)) {
            return $this->validateNie($matches[1], $matches[2], $matches[3]);
        }

        if (preg_match('/^([A-HJNP-SUVW])(\d{7})([0-9A-Z])$/', $input, $matches)) {
            return $this->validateCif($matches[2], $matches[3]);
        }

        return false;
    }

    private function validateDni(int $number, string $control): bool
    {
        return mb_substr('TRWAGMYFPDXBNJZSQVHLCKE', $number % 23, 1) === $control;
    }

    private function validateNie(string $prefix, string $number, string $control): bool
    {
        if ($prefix === 'Y') {
            return $this->validateDni((int) ('1' . $number), $control);
        }

        if ($prefix === 'Z') {
            return $this->validateDni((int) ('2' . $number), $control);
        }

        return $this->validateDni((int) $number, $control);
    }

    private function validateCif(string $number, string $control): bool
    {
        $code = 0;
        $position = 1;
        foreach (str_split($number) as $digit) {
            $digit = (int) $digit;
            $increaser = $digit;
            if ($position % 2 !== 0) {
                $increaser = array_sum(str_split((string) ($digit * 2)));
            }

            $code += $increaser;
            ++$position;
        }

        $digits = str_split((string) $code);
        $lastDigit = (int) array_pop($digits);
        $key = $lastDigit === 0 ? 0 : 10 - $lastDigit;

        if (is_numeric($control)) {
            return (int) $key === (int) $control;
        }

        return mb_substr('JABCDEFGHI', $key % 10, 1) === $control;
    }
}
