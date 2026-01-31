<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Formatters;

use Respect\StringFormatter\Formatter;

final readonly class FormatterStub implements Formatter
{
    public function __construct(
        private string $formattedValue,
    ) {
    }

    public function format(string $input): string
    {
        return $this->formattedValue;
    }
}
