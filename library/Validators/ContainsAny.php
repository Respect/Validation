<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Kirill Dlussky <kirill@dlussky.ru>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Validation\Exceptions\InvalidValidatorException;
use Respect\Validation\Message\Template;
use Respect\Validation\Validators\Core\Envelope;

use function array_map;
use function count;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must contain at least one value from {{needles}}',
    '{{subject}} must not contain any value from {{needles}}',
)]
final class ContainsAny extends Envelope
{
    /** @param non-empty-array<mixed> $needles */
    public function __construct(array $needles, bool $identical = false)
    {
        if (empty($needles)) {
            throw new InvalidValidatorException('At least one value must be provided');
        }

        $validators = $this->getValidators($needles, $identical);

        parent::__construct(
            count($validators) === 1 ? $validators[0] : new AnyOf(...$validators),
            ['needles' => $needles],
        );
    }

    /**
     * @param mixed[] $needles
     *
     * @return Contains[]
     */
    private function getValidators(array $needles, bool $identical): array
    {
        return array_map(
            static function ($needle) use ($identical): Contains {
                return new Contains($needle, $identical);
            },
            $needles,
        );
    }
}
