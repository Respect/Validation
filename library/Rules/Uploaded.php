<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Psr\Http\Message\UploadedFileInterface;
use SplFileInfo;

use function is_scalar;
use function is_uploaded_file;

/**
 * Validates if the given data is a file that was uploaded via HTTP POST.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Paul Karikari <paulkarikari1@gmail.com>
 */
final class Uploaded extends AbstractRule
{
    /**
     * @deprecated Calling `validate()` directly from rules is deprecated. Please use {@see \Respect\Validation\Validator::isValid()} instead.
     */
    public function validate($input): bool
    {
        if ($input instanceof SplFileInfo) {
            return $this->validate($input->getPathname());
        }

        if ($input instanceof UploadedFileInterface) {
            return true;
        }

        if (!is_scalar($input)) {
            return false;
        }

        return is_uploaded_file((string) $input);
    }
}
