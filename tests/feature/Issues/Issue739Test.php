<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('https://github.com/Respect/Validation/issues/739', expectAll(
    fn() => v::when(v::alwaysInvalid(), v::alwaysValid())->assert('foo'),
    '"foo" is invalid',
    '- "foo" is invalid',
    ['alwaysInvalid' => '"foo" is invalid']
));
