<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Stubs;

use Respect\Validation\Rules\Date;
use Respect\Validation\Rules\DateTimeDiff;
use Respect\Validation\Rules\Email;
use Respect\Validation\Rules\LessThanOrEqual;
use Respect\Validation\Rules\NotEmpty;
use Respect\Validation\Rules\Phone;

final class WithAttributes
{
    public function __construct(
        #[NotEmpty]
        public string $name,
        #[Email]
        public string $email,
        #[Date('Y-m-d')]
        #[DateTimeDiff('years', new LessThanOrEqual(25))]
        public string $birthdate,
        #[Phone]
        public ?string $phone = null,
        public ?string $address = null,
    ) {
    }
}
