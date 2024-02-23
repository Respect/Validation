<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\InvalidRuleConstructorException;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;

use function array_diff;
use function array_merge;
use function array_values;
use function count;
use function in_array;
use function mb_detect_encoding;
use function mb_list_encodings;

#[Template(
    '{{name}} must be in the {{charset|raw}} charset',
    '{{name}} must not be in the {{charset|raw}} charset',
)]
final class Charset extends Standard
{
    /** @var non-empty-array<string> */
    private readonly array $charset;

    public function __construct(string $charset, string ...$charsets)
    {
        $available = mb_list_encodings();
        $charsets = array_merge([$charset], $charsets);
        $diff = array_diff($charsets, $available);
        if (count($diff) > 0) {
            throw new InvalidRuleConstructorException('Invalid charset provided: %s', array_values($diff));
        }

        $this->charset = $charsets;
    }

    public function evaluate(mixed $input): Result
    {
        return new Result(
            in_array(mb_detect_encoding($input, $this->charset, true), $this->charset),
            $input,
            $this,
            ['charset' => $this->charset],
        );
    }
}
