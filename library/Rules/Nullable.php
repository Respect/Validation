<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Message\Template;

#[Template(
    'The value must be nullable',
    'The value must not be null',
    self::TEMPLATE_STANDARD,
)]
#[Template(
    '{{name}} must be nullable',
    '{{name}} must not be null',
    self::TEMPLATE_NAMED,
)]
final class Nullable extends AbstractWrapper
{
    public const TEMPLATE_NAMED = 'named';

    public function assert(mixed $input): void
    {
        if ($input === null) {
            return;
        }

        parent::assert($input);
    }

    public function check(mixed $input): void
    {
        if ($input === null) {
            return;
        }

        parent::check($input);
    }

    public function validate(mixed $input): bool
    {
        if ($input === null) {
            return true;
        }

        return parent::validate($input);
    }

    protected function getStandardTemplate(mixed $input): string
    {
        if ($input || $this->getName()) {
            return self::TEMPLATE_NAMED;
        }

        return self::TEMPLATE_STANDARD;
    }
}
