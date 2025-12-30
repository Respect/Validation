<?php

declare(strict_types=1);

namespace Respect\Validation\Rules\Core;

use Respect\Validation\Rule;

interface KeyRelated extends Rule
{
    public function getKey(): int|string;
}
