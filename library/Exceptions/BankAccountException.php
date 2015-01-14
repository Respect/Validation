<?php
namespace Respect\Validation\Exceptions;

class BankAccountException extends ValidationException
{
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must be a bank account',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not be a bank account',
        )
    );
}
