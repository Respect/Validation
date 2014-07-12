<?php

namespace Respect\Validation\Exceptions;

class ExistsException extends ValidationException
{

    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must exists',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not exists',
        )
    );

}
