<?php

namespace Respect\Validation\Exceptions;

class AllOfException extends AbstractCompositeException
{

    public static $defaultTemplates = array(
        self::NONE => 'All of the %3$d required rules must pass for %1$s',
        self::SOME => 'These %2$d rules must pass for %1$s',
    );

}