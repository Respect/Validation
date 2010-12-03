<?php

namespace Respect\Validation\Exceptions;

class StringLengthException extends ValidationException
{
    const INVALID_LESS= 'StringLength_1';
    const INVALID_MORE= 'StringLength_2';
    const INVALID_BOTH= 'StringLength_3';
    public static $defaultTemplates = array(
        self::INVALID_LESS => '"%s" is shorter than "%s"',
        self::INVALID_MORE => '"%s" is longer than "%s"',
        self::INVALID_BOTH => '"%s" is shorter than "%s" and longer than "%s"',
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