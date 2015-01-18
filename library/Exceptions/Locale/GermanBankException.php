<?php
namespace Respect\Validation\Exceptions\Locale;

use Respect\Validation\Exceptions\BankException;

class GermanBankException extends BankException
{
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must be a german bank',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not be a german bank',
        )
    );
}
