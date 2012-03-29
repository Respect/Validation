<?php

namespace Respect\Validation\Exceptions;

class ZendException extends AbstractNestedException
{

    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}}',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}}',
        )
    );

}

