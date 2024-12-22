<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('https://github.com/Respect/Validation/issues/805', expectAll(
    fn() => v::key('email', v::email()->setTemplate('WRONG EMAIL!!!!!!'))->assert(['email' => 'qwe']),
    'WRONG EMAIL!!!!!!',
    '- WRONG EMAIL!!!!!!',
    ['email' => 'WRONG EMAIL!!!!!!'],
));
