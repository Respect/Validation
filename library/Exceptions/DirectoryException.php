<?php
namespace Respect\Validation\Exceptions;

class DirectoryException extends ValidationException
{
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must be a directory',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not be a directory',
        )
    );
}

