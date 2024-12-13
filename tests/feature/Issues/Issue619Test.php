<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('https://github.com/Respect/Validation/issues/619', expectAll(
    fn() => v::instance(stdClass::class)->setTemplate('invalid object')->assert('test'),
    'invalid object',
    '- invalid object',
    ['instance' => 'invalid object']
));
