<?php

namespace Respect\Validation\Exceptions;

class BetweenException extends ValidationException
{
    const INVALID_LESS= 'Between_1';
    const INVALID_MORE= 'Between_2';
    const INVALID_BOTH= 'Between_3';
    public static $defaultTemplates = array(
        self::INVALID_LESS => '"%s" is less than "%2$s"',
        self::INVALID_MORE => '"%s" is more than "%3$s"',
        self::INVALID_BOTH => '"%s" is less than "%s" and more than "%s"',
    );

    public function chooseTemplate($input, $min, $max, $isMinValid, $isMaxValid)
    {
        if (!$isMinValid && !$isMaxValid)
            return self::INVALID_BOTH;
        if (!$isMinValid)
            return self::INVALID_LESS;
        if (!$isMaxValid)
            return self::INVALID_MORE;
    }

}