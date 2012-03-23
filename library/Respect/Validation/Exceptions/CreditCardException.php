<?php

namespace Respect\Validation\Exceptions;

class CreditCardException extends ValidationException
{

    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must be a valid Credit Card number',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not be a valid Credit Card number',
        )
    );

}
