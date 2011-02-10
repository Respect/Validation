<?php

namespace Respect\Validation\Exceptions;

class KeyException extends AttributeException
{

    public static $defaultTemplates = array(
        self::NOT_PRESENT => 'Key {{reference}} must be present on {{name}}',
        self::INVALID => 'Key {{reference}} must be valid on {{name}}',
    );

}
