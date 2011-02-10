<?php

namespace Respect\Validation\Exceptions;

class ZendException extends AbstractRelatedException
{

    public static $defaultTemplates = array(
        self::STANDARD => '{{name}}',
    );

}
