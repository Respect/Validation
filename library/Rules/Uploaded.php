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

final class Uploaded extends AbstractRule
{
    public function validate(mixed $input): bool
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
