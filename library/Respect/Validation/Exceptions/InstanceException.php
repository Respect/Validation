<?php

namespace Respect\Validation\Exceptions;

class InstanceException extends ValidationException
{

    public static $defaultTemplates = array(
        '"%s" is not an instance of "%s"',
    );

}