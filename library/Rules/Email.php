<?php
namespace Respect\Validation\Rules;

use Egulias\EmailValidator\EmailValidator;

class Email extends AbstractRule
{
    public function __construct(EmailValidator $emailValidator = null)
    {
        $this->emailValidator = $emailValidator;
    }

    public function getEmailValidator()
    {
        if (!$this->emailValidator instanceof EmailValidator
            && class_exists('Egulias\EmailValidator\EmailValidator')) {
            $this->emailValidator = new EmailValidator();
        }

        return $this->emailValidator;
    }

    public function validate($input)
    {
        $emailValidator = $this->getEmailValidator();
        if (null !== $emailValidator) {
            return $emailValidator->isValid($input);
        }

        return is_string($input) && filter_var($input, FILTER_VALIDATE_EMAIL);
    }
}
