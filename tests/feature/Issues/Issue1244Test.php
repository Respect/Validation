<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('https://github.com/Respect/Validation/issues/1244', expectAll(
    fn() => v::key('firstname', v::notBlank()->setName('First Name'))->assert([]),
    'First Name must be present',
    '- First Name must be present',
    ['firstname' => 'First Name must be present']
));
