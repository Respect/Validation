<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Danilo Correa <danilosilva87@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use finfo;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Validator;
use SplFileInfo;

use function is_file;
use function is_string;

use const FILEINFO_MIME_TYPE;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must have the {{mimetype}} MIME type',
    '{{subject}} must not have the {{mimetype}} MIME type',
)]
final readonly class Mimetype implements Validator
{
    public function __construct(
        private string $mimetype,
    ) {
    }

    public function evaluate(mixed $input): Result
    {
        if ($input instanceof SplFileInfo) {
            return $this->evaluate($input->getPathname());
        }

        $parameters = ['mimetype' => $this->mimetype];

        if (!is_string($input) || !is_file($input)) {
            return Result::failed($input, $this, $parameters);
        }

        return Result::of(
            $this->mimetype === (new finfo(FILEINFO_MIME_TYPE))->file($input),
            $input,
            $this,
            $parameters,
        );
    }
}
