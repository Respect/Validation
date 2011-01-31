<?php

namespace Respect\Validation\Exceptions;

class MostOfException extends AbstractCompositeException
{

    public static $defaultTemplates = array(
        'None of %3$d required rules passed',
        '%2$d of %3$d required rules did not passed',
    );

}