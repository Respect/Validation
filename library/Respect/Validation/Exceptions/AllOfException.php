<?php

namespace Respect\Validation\Exceptions;

class AllOfException extends AbstractGroupedException
{

    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::NONE => 'All of the {{failed}} required rules must pass for {{name}}',
            self::SOME => 'These {{failed}} rules must pass for {{name}}',
        ),
        self::MODE_NEGATIVE => array(
            self::NONE => 'None of these {{failed}} rules must pass for {{name}}',
            self::SOME => 'These {{failed}} rules must not pass for {{name}}',
        )
    );

}

