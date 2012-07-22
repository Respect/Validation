<?php

namespace Respect\Validation\Exceptions;

class AlwaysInalidException extends ValidationException
{

    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} is always invalid',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} is always valid',
        )
    );

}

