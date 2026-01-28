<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 */

declare(strict_types=1);

namespace Respect\Validation;

interface IsValid extends Validator
{
    public function isValid(mixed $input): bool;
}
