<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Graham Campbell <graham@mineuk.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 * SPDX-FileContributor: paul karikari <paulkarikari1@gmail.com>
 * SPDX-FileContributor: v0idpwn <v0idpwn@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Psr\Http\Message\UploadedFileInterface;
use Respect\Validation\Message\Template;
use Respect\Validation\Validators\Core\Simple;
use SplFileInfo;

use function function_exists;
use function is_scalar;
use function is_uploaded_file;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be an uploaded file',
    '{{subject}} must not be an uploaded file',
)]
final class Uploaded extends Simple
{
    public function isValid(mixed $input): bool
    {
        if ($input instanceof SplFileInfo) {
            return $this->isValid($input->getPathname());
        }

        if ($input instanceof UploadedFileInterface) {
            return true;
        }

        if (!is_scalar($input)) {
            return false;
        }

        if (function_exists('mock_is_uploaded_file')) {
            return mock_is_uploaded_file((string) $input);
        }

        return is_uploaded_file((string) $input);
    }
}
