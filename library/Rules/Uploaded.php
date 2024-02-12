<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Psr\Http\Message\UploadedFileInterface;
use Respect\Validation\Message\Template;
use SplFileInfo;

use function is_scalar;
use function is_uploaded_file;

#[Template(
    '{{name}} must be an uploaded file',
    '{{name}} must not be an uploaded file',
)]
final class Uploaded extends Simple
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
