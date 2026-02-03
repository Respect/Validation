<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Graham Campbell <graham@mineuk.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Krzysztof Śmiałek <admin@avensome.net>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 * SPDX-FileContributor: Singwai Chan <singwai.chan@live.com>
 * SPDX-FileContributor: paul karikari <paulkarikari1@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Validator;

use function array_diff;
use function is_array;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be subset of {{superset}}',
    '{{subject}} must not be subset of {{superset}}',
)]
final readonly class Subset implements Validator
{
    /** @param mixed[] $superset */
    public function __construct(
        private array $superset,
    ) {
    }

    public function evaluate(mixed $input): Result
    {
        $parameters = ['superset' => $this->superset];
        if (!is_array($input)) {
            return Result::failed($input, $this, $parameters);
        }

        return Result::of(array_diff($input, $this->superset) === [], $input, $this, $parameters);
    }
}
