<?php

namespace Respect\Validation\Exceptions;

class AllOfException extends AbstractCompositeException
{

    public static $defaultTemplates = array(
        self::INVALID_NONE => 'None of %3$d required rules passed',
        self::INVALID_SOME => '%2$d of %3$d required rules did not passed',
    );

}