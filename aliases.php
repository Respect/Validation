<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

use Respect\Validation\ValidatorBuilder;

if (!class_exists('v')) {
    class_alias(ValidatorBuilder::class, 'v');
}
