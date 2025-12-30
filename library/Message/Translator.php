<?php

declare(strict_types=1);

namespace Respect\Validation\Message;

interface Translator
{
    public function translate(string $message): string;
}
