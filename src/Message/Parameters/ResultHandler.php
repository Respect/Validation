<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Message\Parameters;

use Respect\Stringifier\Handler;
use Respect\Validation\Result;

use function sprintf;

final readonly class ResultHandler implements Handler
{
    public function __construct(
        private Handler $handler,
    ) {
    }

    public function handle(mixed $raw, int $depth): string|null
    {
        if (!$raw instanceof Result) {
            return null;
        }

        if ($raw->path === null && $raw->name === null) {
            return $this->handler->handle($raw->input, $depth);
        }

        if ($raw->name === null) {
            return $this->handler->handle($raw->path, $depth);
        }

        if ($raw->path === null || $raw->hasPrecedentName) {
            return $this->handler->handle($raw->name, $depth);
        }

        return sprintf(
            '%s (<- %s)',
            $this->handler->handle($raw->path, $depth),
            $this->handler->handle($raw->name, $depth),
        );
    }
}
