<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Andy Wendt <andy@awendt.com>
 * SPDX-FileContributor: Graham Campbell <graham@mineuk.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 */

declare(strict_types=1);

use Respect\Validation\ValidatorBuilder;
use Respect\StringFormatter\FormatterBuilder;

if (!class_exists('v')) {
    class_alias(ValidatorBuilder::class, 'v');
}

if (!class_exists('f')) {
    class_alias(FormatterBuilder::class, 'f');
}
