<?php

namespace Respect\Validation\Exceptions;

class EachException extends AbstractNestedException
{

    public static $defaultTemplates = array(
        self::STANDARD => 'Each item in {{name}} must be valid',
    );

}
