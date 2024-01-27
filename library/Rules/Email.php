<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\RFCValidation;

use function class_exists;
use function filter_var;
use function is_string;

use const FILTER_VALIDATE_EMAIL;

final class Email extends AbstractRule
{
    private ?EmailValidator $validator = null;

    public function __construct(?EmailValidator $validator = null)
    {
        $this->validator = $validator ?: $this->createEmailValidator();
    }

    public function validate(mixed $input): bool
    {
        if (!is_string($input)) {
            return false;
        }

        if ($this->validator !== null) {
            return $this->validator->isValid($input, new RFCValidation());
        }

        return (bool) filter_var($input, FILTER_VALIDATE_EMAIL);
    }

    private function createEmailValidator(): ?EmailValidator
    {
        if (class_exists(EmailValidator::class)) {
            return new EmailValidator();
        }

        return null;
    }
}
