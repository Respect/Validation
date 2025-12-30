<?php

declare(strict_types=1);

namespace Respect\Validation\Test\Message;

use Respect\Stringifier\Stringifier;

final class NullStringifier implements Stringifier
{
    public function stringify(mixed $raw, int $depth): string|null
    {
        return null;
    }
}
