<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Stubs;

use Respect\Validation\Rules as Rule;

#[Rule\AnyOf(
    new Rule\Property('email', new Rule\NotUndef()),
    new Rule\Property('phone', new Rule\NotUndef()),
)]
final class WithAttributes
{
    public function __construct(
        #[Rule\NotEmpty]
        public string $name,
        #[Rule\Date('Y-m-d')]
        #[Rule\DateTimeDiff('years', new Rule\LessThanOrEqual(25))]
        public string $birthdate,
        #[Rule\Email]
        public ?string $email = null,
        #[Rule\Phone]
        public ?string $phone = null,
        public ?string $address = null,
    ) {
    }
}
