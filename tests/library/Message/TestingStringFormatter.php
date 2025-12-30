<?php

declare(strict_types=1);

namespace Respect\Validation\Test\Message;

use Respect\Validation\Message\Renderer;
use Respect\Validation\Message\StringFormatter;
use Respect\Validation\Result;

final class TestingStringFormatter implements StringFormatter
{
    public function __construct(
        private readonly string $prefix = '',
    ) {
    }

    /** @param array<string|int, mixed> $templates */
    public function format(Result $result, Renderer $renderer, array $templates): string
    {
        return $this->prefix . $renderer->render($result, $templates);
    }
}
