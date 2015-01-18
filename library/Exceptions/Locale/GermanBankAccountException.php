<?php
namespace Respect\Validation\Exceptions\Locale;

use Respect\Validation\Exceptions\BankAccountException;

class GermanBankAccountException extends BankAccountException
{
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must be a german bank account',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not be a german bank account',
        )
    );
}
