<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Validators\Core;

use Respect\Validation\Validator;

interface KeyRelated extends Validator
{
    public function getKey(): int|string;
}
