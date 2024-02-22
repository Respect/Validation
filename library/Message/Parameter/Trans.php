<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Message\Parameter;

use function call_user_func;
use function is_string;

final class Trans implements Processor
{
    /** @var callable */
    private $translator;

    public function __construct(
        callable $translator,
        private readonly Processor $nextProcessor,
    ) {
        $this->translator = $translator;
    }

    public function process(string $name, mixed $value, ?string $modifier = null): string
    {
        if ($modifier === 'trans' && is_string($value)) {
            return call_user_func($this->translator, $value);
        }

        return $this->nextProcessor->process($name, $value, $modifier);
    }
}
