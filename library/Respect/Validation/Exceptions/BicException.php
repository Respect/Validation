<?php

namespace Respect\Validation\Exceptions;

class BicException extends ValidationException
{

    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must be a valid Business Identifier Code (BIC)',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not be a valid Business Identifier Code (BIC)',
        )
    );

}
