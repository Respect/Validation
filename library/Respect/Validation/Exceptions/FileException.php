<?php

namespace Respect\Validation\Exceptions;

class FileException extends ValidationException
{

    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must be a file',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not be a file',
        )
    );

}
