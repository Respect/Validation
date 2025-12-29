<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Stubs;

use Respect\Validation\Rules as Rule;

#[Rule\AnyOf(
    new Rule\Property('email', new Rule\Not(new Rule\Undef())),
    new Rule\Property('phone', new Rule\Not(new Rule\Undef())),
)]
final class WithAttributes extends ParentWithAttributes
{
    public function __construct(
        #[Rule\Not(new Rule\Undef())]
        public string $name,
        #[Rule\Date('Y-m-d')]
        #[Rule\DateTimeDiff('years', new Rule\LessThanOrEqual(25))]
        public string $birthdate,
        string|null $email = null,
        string|null $phone = null,
        string|null $address = null,
    ) {
        parent::__construct($email, $phone, $address);
    }
}
