<?php
namespace Respect\Validation\Exceptions;

class KeyException extends AttributeException
{
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::NOT_PRESENT => 'Key {{name}} must be present',
            self::INVALID => 'Key {{name}} must be valid',
        ),
        self::MODE_NEGATIVE => array(
            self::NOT_PRESENT => 'Key {{name}} must not be present',
            self::INVALID => 'Key {{name}} must not be valid',
        )
    );
}

