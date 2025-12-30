<?php

declare(strict_types=1);

namespace Respect\Validation\Message;

interface Modifier
{
    public function modify(mixed $value, string|null $pipe): string;
}
