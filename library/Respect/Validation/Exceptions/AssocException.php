<?php
namespace Respect\Validation\Exceptions;

class AssocException extends AbstractGroupedException
{
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::NONE => 'All of the required rules must pass for the given data',
            self::SOME => 'These rules must pass for the given data',
        ),
        self::MODE_NEGATIVE => array(
            self::NONE => 'None of these rules must pass for the given data',
            self::SOME => 'These rules must not pass for the given data',
        )
    );
}

