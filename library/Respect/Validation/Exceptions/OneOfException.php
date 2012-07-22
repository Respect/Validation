<?php

namespace Respect\Validation\Exceptions;

class OneOfException extends AbstractNestedException
{

    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => 'At least one of these rules must pass for {{name}}',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => 'At least one of these rules must not pass for {{name}}',
        )
    );

}

