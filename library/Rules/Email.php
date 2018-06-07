<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\RFCValidation;
use const FILTER_VALIDATE_EMAIL;
use function class_exists;
use function filter_var;
use function is_string;

/**
 * Validates an email address.
 *
 * @author Eduardo Gulias Davis <me@egulias.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Paul Karikari <paulkarikari1@gmail.com>
 */
final class Email extends AbstractRule
{
    /**
     * Assigns email validator.
     *
     * @param EmailValidator $emailValidator
     */
    public function __construct(EmailValidator $emailValidator = null)
    {
        $this->emailValidator = $emailValidator;
    }

    /**
     * Gets email validator.
     *
     * @return EmailValidator | null
     */
    public function getEmailValidator()
    {
        if (class_exists(EmailValidator::class)
            && !$this->emailValidator instanceof EmailValidator) {
            $this->emailValidator = new EmailValidator();
        }

        return $this->emailValidator;
    }

    /**
     * {@inheritdoc}
     */
    public function validate($input): bool
    {
        $emailValidator = $this->getEmailValidator();
        if (!$emailValidator instanceof EmailValidator) {
            return is_string($input) && filter_var($input, FILTER_VALIDATE_EMAIL);
        }

        if (!class_exists(RFCValidation::class)) {
            return $emailValidator->isValid($input);
        }

        return $emailValidator->isValid($input, new RFCValidation());
    }
}
