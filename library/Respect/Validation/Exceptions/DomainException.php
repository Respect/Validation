<?php

namespace Respect\Validation\Exceptions;

class DomainException extends AbstractNestedException
{

    public static $defaultTemplates = array(
        self::STANDARD => '{{name}} must be a valid domain',
    );

}
