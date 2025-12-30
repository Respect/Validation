<?php

declare(strict_types=1);

namespace Respect\Validation\Rules\Core;

use Respect\Validation\Name;

interface Nameable
{
    public function getName(): Name|null;
}
