<?php

namespace Respect\Validation\Exceptions;

class MinimumAgeException extends ValidationException
{
    
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => 'The age must be {{age}} years or more.',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => 'The age must not be {{age}} years or more.',
        )
    );

}
