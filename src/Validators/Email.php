<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Eduardo Gulias Davis <me@egulias.com>
 * SPDX-FileContributor: Graham Campbell <graham@mineuk.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Konstantin <kolodnitsky@gmail.com>
 * SPDX-FileContributor: Mikko Pesari <mikko@pesari.fi>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 * SPDX-FileContributor: paul karikari <paulkarikari1@gmail.com>
 * SPDX-FileContributor: Kir Kolyshkin <kolyshkin@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\RFCValidation;
use Respect\Validation\Message\Template;
use Respect\Validation\Validators\Core\Simple;

use function class_exists;
use function filter_var;
use function func_num_args;
use function is_string;

use const FILTER_VALIDATE_EMAIL;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be a valid email address',
    '{{subject}} must not be an email address',
)]
final class Email extends Simple
{
    private readonly EmailValidator|null $validator;

    public function __construct(EmailValidator|null $validator = null)
    {
        if ($validator === null && func_num_args() === 0 && class_exists(EmailValidator::class)) {
            $validator = new EmailValidator();
        }

        $this->validator = $validator;
    }

    public function isValid(mixed $input): bool
    {
        if (!is_string($input)) {
            return false;
        }

        if ($this->validator !== null) {
            return $this->validator->isValid($input, new RFCValidation());
        }

        return (bool) filter_var($input, FILTER_VALIDATE_EMAIL);
    }
}
