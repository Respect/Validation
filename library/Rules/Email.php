<?php
namespace Respect\Validation\Rules;

class Email extends AbstractRule
{
    public function validate($input)
    {
        if (class_exists('\Egulias\EmailValidator\EmailValidator')) {
            $strictValidator = new \Egulias\EmailValidator\EmailValidator();

            $validationResult = $strictValidator->isValid($input);
        } else {
            $validationResult = is_string($input) && filter_var($input, FILTER_VALIDATE_EMAIL);
        }

        return $validationResult;
    }
}
