<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Psr\Http\Message\StreamInterface;
use SplFileInfo;

use function is_readable;
use function is_string;

/**
 * Validates if the given data is a file exists and is readable.
 *
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class Readable extends AbstractRule
{
    /**
     * @deprecated Calling `validate()` directly from rules is deprecated. Please use {@see \Respect\Validation\Validator::isValid()} instead.
     */
    public function validate($input): bool
    {
        if ($input instanceof SplFileInfo) {
            return $input->isReadable();
        }

        if ($input instanceof StreamInterface) {
            return $input->isReadable();
        }

        return is_string($input) && is_readable($input);
    }
}
