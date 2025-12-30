<?php

declare(strict_types=1);

namespace Respect\Validation\Test\Message;

use Respect\Stringifier\Stringifier;

use function print_r;
use function sprintf;

final class TestingStringifier implements Stringifier
{
    public function stringify(mixed $raw, int $depth): string|null
    {
        return sprintf('<%s:%d>', print_r($raw, true), $depth);
    }
}
