<?php

namespace Respect\Validation\Exceptions;

class OneOfException extends AbstractRelatedException
{

    public static $defaultTemplates = array(
        self::STANDARD => 'At least one of these rules must pass for {{name}}',
    );

}
