<?php

namespace Respect\Validation\Exceptions;

class OneOfException extends AbstractCompositeException
{

    public static $defaultTemplates = array(
        self::INVALID_NONE => 'None of the %3$d rules passed',
        self::INVALID_SOME => '%2$d of the %3$d rules did not passed',
    );

}