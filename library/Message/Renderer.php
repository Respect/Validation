<?php

declare(strict_types=1);

namespace Respect\Validation\Message;

use Respect\Validation\Result;

interface Renderer
{
    /** @param array<string|int, mixed> $templates */
    public function render(Result $result, array $templates): string;
}
