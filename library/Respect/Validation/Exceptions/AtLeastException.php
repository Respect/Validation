<?php

namespace Respect\Validation\Exceptions;

class AtLeastException extends AbstractCompositeException
{

    public static $defaultTemplates = array(
        self::NONE => 'None of %4$d rules passed (%3$d required)',
        self::SOME => '%2$d of %4$d rules did not passed (%3$d required)',
    );

}