<?php

declare(strict_types=1);

namespace Respect\Validation\Message;

use Attribute;
use Respect\Validation\Rule;

#[Attribute(Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
final readonly class Template
{
    public function __construct(
        public string $default,
        public string $inverted,
        public string $id = Rule::TEMPLATE_STANDARD,
    ) {
    }
}
