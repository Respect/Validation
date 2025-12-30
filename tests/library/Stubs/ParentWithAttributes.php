<?php

declare(strict_types=1);

namespace Respect\Validation\Test\Stubs;

use Respect\Validation\Rules as Rule;

abstract class ParentWithAttributes
{
    public function __construct(
        #[Rule\Email]
        private string|null $email = null,
        #[Rule\Phone]
        protected string|null $phone = null,
        public string|null $address = null,
    ) {
    }
}
