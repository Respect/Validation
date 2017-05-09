<?php
namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractRule;

/**
 * Validates if a text includes Turkish Characters.
 *
 * @author Ahmet Güneş <ahmetgunes@mail.com>
 */
class TurkishCharacter extends AbstractRule
{
    const TURKISH_CHARACTER_REGEX = '([çığöşüÇİĞÖŞÜ]+)';

    /**
     * Iterates over Turkish Characters array to detect turkishCharacters
     * @param $input
     * @return bool
     */
    public function validate($input)
    {
        return preg_match(self::TURKISH_CHARACTER_REGEX, $input) ? true : false;
    }
}
