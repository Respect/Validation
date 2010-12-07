<?php

namespace Respect\Validation\Exceptions;

class AtLeastException extends AbstractCompositeException
{

    public static $defaultTemplates = array(
        self::INVALID_NONE => 'None of %4$d rules passed (%3$d required)',
        self::INVALID_SOME => '%2$d of %4$d rules did not passed (%3$d required)',
    );

}