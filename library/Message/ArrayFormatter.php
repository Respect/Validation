<?php

declare(strict_types=1);

namespace Respect\Validation\Message;

use Respect\Validation\Result;

interface ArrayFormatter
{
    /**
     * @param array<string|int, mixed> $templates
     *
     * @return array<string|int, mixed>
     */
    public function format(Result $result, Renderer $renderer, array $templates): array;
}
