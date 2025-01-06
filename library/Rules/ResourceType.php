<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use function is_resource;

/**
 * Validates whether the input is a resource.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class ResourceType extends AbstractRule
{
    /**
     * @deprecated Calling `validate()` directly from rules is deprecated. Please use {@see \Respect\Validation\Validator::isValid()} instead.
     */
    public function validate($input): bool
    {
        return is_resource($input);
    }
}
