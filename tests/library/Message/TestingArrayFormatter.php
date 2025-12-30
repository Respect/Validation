<?php

declare(strict_types=1);

namespace Respect\Validation\Test\Message;

use Respect\Validation\Message\ArrayFormatter;
use Respect\Validation\Message\Renderer;
use Respect\Validation\Result;

final class TestingArrayFormatter implements ArrayFormatter
{
    /**
     * @param array<string|int, mixed> $templates
     *
     * @return array<string|int, mixed>
     */
    public function format(Result $result, Renderer $renderer, array $templates): array
    {
        return [$result->id->value => $renderer->render($result, $templates)];
    }
}
