<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Result;

use function implode;
use function is_scalar;
use function str_replace;
use function str_split;

abstract class Filter extends Standard
{
    public const TEMPLATE_EXTRA = '__extra__';

    private readonly string $additionalChars;

    abstract protected function isValid(string $input): bool;

    public function __construct(string ...$additionalChars)
    {
        $this->additionalChars = implode($additionalChars);
    }

    public function evaluate(mixed $input): Result
    {
        $template = $this->additionalChars ? self::TEMPLATE_EXTRA : self::TEMPLATE_STANDARD;
        $parameters = $this->additionalChars ? ['additionalChars' => $this->additionalChars] : [];
        if (!is_scalar($input)) {
            return Result::failed($input, $this, $parameters, $template);
        }

        $stringInput = (string) $input;
        if ($stringInput === '') {
            return Result::failed($input, $this, $parameters, $template);
        }

        $filteredInput = $this->filter($stringInput);
        $isValid = $filteredInput === '' || $this->isValid($filteredInput);

        return new Result($isValid, $input, $this, $parameters, $template);
    }

    private function filter(string $input): string
    {
        return str_replace(str_split($this->additionalChars), '', $input);
    }
}
