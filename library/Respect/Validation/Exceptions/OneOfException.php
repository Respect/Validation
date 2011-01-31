<?php

namespace Respect\Validation\Exceptions;

class OneOfException extends AbstractCompositeException
{

    public static $defaultTemplates = array(
        'None of the %4$d rules passed',
        '%2$d of the %4$d rules did not passed',
    );

}