<?php

namespace Respect\Validation\Exceptions;

class ZendException extends AbstractNestedException
{

    public static $defaultTemplates = array(
        self::STANDARD => '{{name}}',
    );

}
