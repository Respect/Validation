<?php

declare(strict_types=1);

namespace Respect\Validation\Test\Message;

use Respect\Validation\Message\Modifier;

use function print_r;
use function sprintf;

final readonly class TestingModifier implements Modifier
{
    public function modify(mixed $value, string|null $pipe): string
    {
        return $pipe ? sprintf('%s(%s)', $pipe, print_r($value, true)) : print_r($value, true);
    }
}
