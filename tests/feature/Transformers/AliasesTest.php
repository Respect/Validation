<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

date_default_timezone_set('UTC');

test('Optional', expectAll(
    fn() => v::optional(v::scalarVal())->assert([]),
    '`[]` must be a scalar value or must be undefined',
    '- `[]` must be a scalar value or must be undefined',
    ['undefOrScalarVal' => '`[]` must be a scalar value or must be undefined'],
));
