<?php

namespace Respect\Validation\Exceptions;

class SfException extends ValidationException
{

    public static $defaultTemplates = array(
        self::STANDARD => '{{name}}',
    );

}
