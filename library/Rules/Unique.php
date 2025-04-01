<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use function array_is_list;
use function in_array;
use function is_array;

/**
 * Validates whether the input array contains only unique values.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Krzysztof Śmiałek <admin@avensome.net>
 * @author Paul Karikari <paulkarikari1@gmail.com>
 */
final class Unique extends AbstractRule
{
    /**
     * @deprecated Calling `validate()` directly from rules is deprecated. Please use {@see \Respect\Validation\Validator::isValid()} instead.
     */
    public function validate($input): bool
    {
        if (!is_array($input)) {
            return false;
        }

        return $input == $this->unique($input);
    }

    /**
     * @param array<mixed, mixed> $input
     *
     * @return array<mixed, mixed>
     */
    private function unique(array $input): array
    {
        if (!array_is_list($input)) {
            return $input;
        }

        $unique = [];
        foreach ($input as $value) {
            $comparedValue = $value;
            if (is_array($comparedValue)) {
                $comparedValue = $this->unique($comparedValue);
            }

            if (in_array($comparedValue, $unique, true)) {
                continue;
            }

            $unique[] = $comparedValue;
        }

        return $unique;
    }
}
