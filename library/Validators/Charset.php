<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Graham Campbell <graham@mineuk.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 * SPDX-FileContributor: William Espindola <oi@williamespindola.com.br>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Validation\Exceptions\InvalidValidatorException;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Validator;

use function array_diff;
use function array_merge;
use function array_values;
use function count;
use function in_array;
use function mb_detect_encoding;
use function mb_list_encodings;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must only contain characters from the {{charset|raw}} charset',
    '{{subject}} must not contain any characters from the {{charset|raw}} charset',
)]
final readonly class Charset implements Validator
{
    /** @var non-empty-array<string> */
    private array $charset;

    public function __construct(string $charset, string ...$charsets)
    {
        $available = mb_list_encodings();
        $charsets = array_merge([$charset], $charsets);
        $diff = array_diff($charsets, $available);
        if (count($diff) > 0) {
            throw new InvalidValidatorException('Invalid charset provided: %s', array_values($diff));
        }

        $this->charset = $charsets;
    }

    public function evaluate(mixed $input): Result
    {
        return Result::of(
            in_array(mb_detect_encoding($input, $this->charset, true), $this->charset),
            $input,
            $this,
            ['charset' => $this->charset],
        );
    }
}
