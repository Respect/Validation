<?php

namespace Respect\Validation\Exceptions;

class OneOfException extends AbstractCompositeException
{

    public static $defaultTemplates = array(
        self::NONE => 'At least one of %4$d rules must pass for %1$s',
        self::SOME => 'At least one of %4$d rules must pass for %1$s, only %2$d passed',
    );

}