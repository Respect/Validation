<?php

namespace Respect\Validation\Exceptions;

class CnpjException extends ValidationException
{

    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must be a valid CNPJ number',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not be a valid CNPJ number',
        )
    );
    
} 
