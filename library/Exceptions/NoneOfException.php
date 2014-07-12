<?php
namespace Respect\Validation\Exceptions;

class NoneOfException extends AbstractNestedException
{
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => 'None of these rules must pass for {{name}}',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => 'All of these rules must pass for {{name}}',
        )
    );
}

