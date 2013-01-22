<?php
namespace Respect\Validation\Exceptions;

class MultipleException extends ValidationException
{
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must be multiple of {{multipleOf}}',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not be multiple of {{multipleOf}}',
        )
    );
}

